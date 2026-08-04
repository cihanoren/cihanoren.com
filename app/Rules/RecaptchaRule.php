<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaRule implements ValidationRule
{
    /**
     * Skor eşiği: 0.0 (muhtemelen bot) - 1.0 (muhtemelen insan)
     */
    protected float $threshold = 0.5;

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (empty($value)) {
            $fail('Doğrulama başarısız oldu, lütfen sayfayı yenileyip tekrar deneyin.');
            return;
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => config('services.recaptcha.secret_key'),
                'response' => $value,
            ])->json();
        } catch (\Exception $e) {
            Log::error('reCAPTCHA doğrulama isteği başarısız: ' . $e->getMessage());
            // Servis çökerse formu tamamen kilitlememek için geçiriyoruz.
            return;
        }

        if (!($response['success'] ?? false)) {
            Log::warning('reCAPTCHA doğrulama reddedildi', ['response' => $response]);
            $fail('Bot doğrulaması başarısız oldu, lütfen tekrar deneyin.');
            return;
        }

        $score = $response['score'] ?? 0;

        if ($score < $this->threshold) {
            Log::warning('reCAPTCHA düşük skor', ['score' => $score]);
            $fail('Bot doğrulaması başarısız oldu, lütfen tekrar deneyin.');
        }
    }
}
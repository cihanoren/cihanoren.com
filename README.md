# cihanoren.com — Portfolyo & Blog Sitesi

Laravel 12 ile geliştirilmiş kişisel portfolyo sitesi. Public tarafta projeler, deneyim, özgeçmiş ve iletişim sayfaları; admin tarafta içerik yönetimi ve güvenlik katmanları bulunuyor.

---

## Teknoloji Stack

| Katman | Teknoloji |
|---|---|
| Backend | Laravel 12, PHP 8.4 |
| Frontend | Blade, Tailwind CSS v4, Vite |
| Veritabanı | SQLite (local), MySQL (production) |
| Auth | Laravel Breeze |
| 2FA | pragmarx/google2fa-laravel |
| QR Kod | bacon/bacon-qr-code |
| Local geliştirme | Laravel Herd |

---

## Kurulum

```bash
git clone <repo>
cd blog-projesi

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate
npm run dev
```

---

## Proje Yapısı

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── ProjectController.php
│   │   ├── ContactController.php
│   │   └── Admin/
│   │       └── TwoFactorController.php
│   └── Middleware/
│       ├── AdminIpWhitelist.php
│       ├── LogLoginAttempts.php
│       └── RequireTwoFactor.php
└── Models/
    └── User.php

resources/views/
├── layouts/
│   ├── public.blade.php       # Public site layout
│   ├── admin.blade.php        # Admin panel layout
│   ├── app.blade.php          # Breeze app layout
│   ├── guest.blade.php        # Breeze guest layout
│   └── navigation.blade.php
├── public/
│   ├── home.blade.php
│   ├── about.blade.php
│   ├── projects.blade.php
│   ├── project-detail.blade.php
│   ├── resume.blade.php
│   └── contact.blade.php
├── admin/
│   └── two-factor/
│       ├── setup.blade.php
│       └── challenge.blade.php
├── auth/
│   └── login.blade.php        # Özel dark temalı login
└── dashboard.blade.php        # Admin dashboard
```

---

## Ortam Değişkenleri (.env)

```env
APP_NAME=Laravel
APP_URL=http://blog-projesi.test

# Admin panel gizli URL prefix — sadece sen bilirsin
ADMIN_PREFIX=cihanoren-panel-admin

# IP whitelist — production'da kendi IP'ni yaz, boş bırakırsan devre dışı
ADMIN_ALLOWED_IPS=
```

---

## Routing

### Public Routes

| Method | URL | Açıklama |
|---|---|---|
| GET | `/` | Ana sayfa |
| GET | `/about` | Hakkımda |
| GET | `/projects` | Projeler listesi |
| GET | `/projects/{slug}` | Proje detay |
| GET | `/resume` | Özgeçmiş |
| GET | `/contact` | İletişim |
| POST | `/contact` | İletişim formu gönder |

### Admin Routes

Admin panel URL'si `.env` dosyasındaki `ADMIN_PREFIX` değişkeninden okunur. Varsayılan olarak `/cihanoren-panel-admin` şeklindedir.

| Method | URL | Açıklama |
|---|---|---|
| GET | `/{ADMIN_PREFIX}` | Dashboard |
| GET | `/{ADMIN_PREFIX}/projects` | Projeler |
| GET | `/{ADMIN_PREFIX}/messages` | Mesajlar |
| GET | `/{ADMIN_PREFIX}/experience` | İş deneyimi |
| GET | `/{ADMIN_PREFIX}/education` | Eğitim |
| GET | `/{ADMIN_PREFIX}/settings` | Site ayarları |
| GET | `/{ADMIN_PREFIX}/2fa/setup` | 2FA kurulum |
| POST | `/{ADMIN_PREFIX}/2fa/enable` | 2FA aktifleştir |
| GET | `/{ADMIN_PREFIX}/2fa/challenge` | 2FA kod girişi |
| POST | `/{ADMIN_PREFIX}/2fa/verify` | 2FA doğrula |
| POST | `/{ADMIN_PREFIX}/2fa/disable` | 2FA kapat |

---

## Güvenlik Katmanları

### 1. Gizli Admin URL
Admin paneline erişim URL'si `.env` dosyasındaki `ADMIN_PREFIX` ile belirlenir. URL tahmin edilemez olduğundan bot ve brute force saldırılarına karşı ilk savunma hattını oluşturur.

### 2. Rate Limiting
Login sayfasına dakikada maksimum 5 deneme yapılabilir. Aşıldığında Laravel otomatik olarak `429 Too Many Requests` döner.

```php
// routes/auth.php
Route::post('login', ...)->middleware('throttle:5,1');
```

### 3. Login Attempt Logging
Her başarılı ve başarısız giriş denemesi `login_logs` tablosuna kaydedilir. Admin dashboard'dan son aktiviteler görülebilir.

```
login_logs tablosu:
- email
- ip_address
- user_agent
- status (success / failed)
- failure_reason
- created_at
```

### 4. Two-Factor Authentication (2FA)
Google Authenticator veya Authy ile TOTP tabanlı iki faktörlü doğrulama.

**Akış:**
1. İlk girişte 2FA setup sayfasına yönlendirilir
2. QR kod taratılır (veya manual key girilir)
3. 6 haneli kod doğrulanır, 2FA aktif hale gelir
4. Sonraki her girişte 2FA challenge ekranı gösterilir
5. Doğru kod girilince `session('2fa_verified') = true` olur ve admin paneline erişim açılır

**2FA secret** veritabanında `encrypt()` ile şifrelenmiş olarak saklanır.

### 5. IP Whitelist (Opsiyonel)
`ADMIN_ALLOWED_IPS` env değişkeni doldurulursa sadece belirtilen IP'lerden admin paneline erişilebilir. Boş bırakılırsa devre dışıdır. Statik IP'n yoksa bu özelliği kullanma — 2FA zaten yeterli koruma sağlar.

---

## Admin Dashboard

Login sonrası erişilen dashboard şunları gösterir:

- **Stats kartları** — Proje sayısı, okunmamış mesajlar, deneyim girişleri, 2FA durumu
- **Quick Actions** — Hızlı erişim linkleri (proje ekle, mesajlar, ayarlar)
- **Recent Login Activity** — Son 5 giriş denemesi (IP, zaman, başarı/başarısız)

---

## Public Site Sayfaları

### Ana Sayfa (/)
- Hero section — başlık, açıklama, CTA butonları
- Marquee skill tag animasyonu (hover'da duruyor)
- Featured projects grid
- CTA strip — iletişim yönlendirmesi
- Stats — yıl, uygulama, platform bilgisi

### About (/about)
- Hero — kısa bio
- Skills & Technologies — Mobile, Backend, AI kategorilerinde skill kartları
- Experience timeline — sol border'lı timeline, tarih + pozisyon + açıklama
- Education — üniversite bilgisi

### Projects (/projects)
- Proje kartları — ikon, başlık, açıklama, teknoloji tag'leri
- Hover efekti ile external link ikonu

### Resume (/resume)
- İsim + pozisyon başlığı
- PDF indirme butonu (`/cv.pdf`)
- Experience, Education, Skills bölümleri

### Contact (/contact)
- Sol: başlık, açıklama, email/GitHub/LinkedIn linkleri
- Sağ: iletişim formu (isim, email, mesaj)
- Başarı/hata flash mesajları

---

## Veritabanı

Şu an aktif olan tablolar:

| Tablo | Açıklama |
|---|---|
| `users` | Admin kullanıcısı, 2FA kolonları |
| `login_logs` | Giriş denemeleri logu |
| `sessions` | Laravel session |
| `cache` | Laravel cache |
| `jobs` | Queue jobs |

Henüz eklenmeyenler (bir sonraki aşama):

| Tablo | Açıklama |
|---|---|
| `projects` | Portfolyo projeleri |
| `messages` | Contact form mesajları |
| `experiences` | İş deneyimleri |
| `educations` | Eğitim bilgileri |
| `settings` | Site ayarları (key-value) |

---

## Yapılacaklar (Roadmap)

- [ ] Project modeli + CRUD admin sayfası
- [ ] Message modeli + admin inbox
- [ ] Experience / Education CRUD
- [ ] Settings modülü (bio, linkler, skills, favicon, title)
- [ ] Contact form mail gönderimi
- [ ] CV PDF upload
- [ ] SEO meta tag yönetimi
- [ ] VPS deploy + domain bağlama (cihanoren.com)

---

## Geliştirme Notları

- Admin panel sidebar linkleri şu an placeholder route'lara bağlı, CRUD modülleri eklendikçe güncellenecek
- Home sayfasında geçici "Admin Panel" butonu var, production'a almadan önce kaldırılacak
- `resources/views/layouts/navigation.blade.php` Breeze'in varsayılan nav dosyası, admin layout'a geçildi ama silinmedi

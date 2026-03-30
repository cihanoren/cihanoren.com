<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('anonymous_id')->unique();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('language', 2)->default('en');
            $table->json('tags')->nullable();
            $table->text('project_idea')->nullable();
            $table->string('personality')->nullable();
            $table->integer('lead_score')->default(0);
            $table->timestamp('last_active_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_sessions');
    }
};
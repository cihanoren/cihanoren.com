<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // English content (fallback to base/TR when empty)
            if (!Schema::hasColumn('projects', 'title_en')) {
                $table->string('title_en')->nullable()->after('title');
            }
            if (!Schema::hasColumn('projects', 'description_en')) {
                $table->text('description_en')->nullable()->after('description');
            }
            if (!Schema::hasColumn('projects', 'content_en')) {
                $table->longText('content_en')->nullable()->after('content');
            }

            // Store links (were referenced in the form/controller but never persisted)
            if (!Schema::hasColumn('projects', 'appstore_url')) {
                $table->string('appstore_url')->nullable()->after('github_url');
            }
            if (!Schema::hasColumn('projects', 'playstore_url')) {
                $table->string('playstore_url')->nullable()->after('appstore_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            foreach (['title_en', 'description_en', 'content_en', 'appstore_url', 'playstore_url'] as $col) {
                if (Schema::hasColumn('projects', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
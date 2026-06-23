<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            // Logo & Branding
            $table->string('logo')->nullable()->after('id');
            $table->string('site_name')->default('RADJATIKET')->after('logo');
            $table->string('site_tagline')->nullable()->after('site_name');
            
            // Hero Section
            $table->string('hero_title')->default('Festival Musik Senja')->after('site_tagline');
            $table->text('hero_subtitle')->nullable()->after('hero_title');
            
            // Features Section
            $table->boolean('show_features')->default(true)->after('hero_subtitle');
            $table->string('feature_1_title')->default('100% Aman')->after('show_features');
            $table->string('feature_1_subtitle')->default('Transaksi Terpercaya')->after('feature_1_title');
            $table->string('feature_2_title')->default('Mudah & Cepat')->after('feature_1_subtitle');
            $table->string('feature_2_subtitle')->default('Proses Instan')->after('feature_2_title');
            $table->string('feature_3_title')->default('E-Ticket Instan')->after('feature_2_subtitle');
            $table->string('feature_3_subtitle')->default('Langsung ke Email')->after('feature_3_title');
            $table->string('feature_4_title')->default('24/7 Support')->after('feature_3_subtitle');
            $table->string('feature_4_subtitle')->default('Siap Membantu')->after('feature_4_title');
        });
    }

    public function down(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->dropColumn([
                'logo', 'site_name', 'site_tagline',
                'hero_title', 'hero_subtitle',
                'show_features',
                'feature_1_title', 'feature_1_subtitle',
                'feature_2_title', 'feature_2_subtitle',
                'feature_3_title', 'feature_3_subtitle',
                'feature_4_title', 'feature_4_subtitle',
            ]);
        });
    }
};

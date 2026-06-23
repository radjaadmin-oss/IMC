<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            // Footer Tagline
            $table->string('footer_tagline')->nullable()->after('show_features');
            
            // Social Media Links
            $table->string('social_instagram')->nullable()->after('footer_tagline');
            $table->string('social_tiktok')->nullable()->after('social_instagram');
            $table->string('social_youtube')->nullable()->after('social_tiktok');
            $table->string('social_facebook')->nullable()->after('social_youtube');
            $table->string('social_twitter')->nullable()->after('social_facebook');
            $table->string('social_whatsapp')->nullable()->after('social_twitter');
            
            // Footer Copyright
            $table->string('footer_copyright')->nullable()->after('social_whatsapp');
            
            // Footer Menu (JSON format)
            $table->text('footer_menu_about')->nullable()->after('footer_copyright');
            $table->text('footer_menu_info')->nullable()->after('footer_menu_about');
            $table->text('footer_menu_categories')->nullable()->after('footer_menu_info');
        });
    }

    public function down(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->dropColumn([
                'footer_tagline',
                'social_instagram',
                'social_tiktok',
                'social_youtube',
                'social_facebook',
                'social_twitter',
                'social_whatsapp',
                'footer_copyright',
                'footer_menu_about',
                'footer_menu_info',
                'footer_menu_categories',
            ]);
        });
    }
};

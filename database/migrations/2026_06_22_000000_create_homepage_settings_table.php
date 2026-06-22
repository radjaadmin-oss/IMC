<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();
            
            // Rekomendasi Event Section
            $table->boolean('show_recommended_events')->default(true);
            $table->string('recommended_events_title')->default('Rekomendasi Event');
            $table->string('recommended_events_subtitle')->nullable();
            
            // Event Terdekat Section
            $table->boolean('show_nearest_events')->default(true);
            $table->string('nearest_events_title')->default('Event Terdekat');
            $table->string('nearest_events_subtitle')->nullable();
            
            // Upcoming Event Section
            $table->boolean('show_upcoming_events')->default(true);
            $table->string('upcoming_events_title')->default('Upcoming Event');
            $table->string('upcoming_events_subtitle')->nullable();
            
            // Popular Event Section
            $table->boolean('show_popular_events')->default(true);
            $table->string('popular_events_title')->default('Popular Event');
            $table->string('popular_events_subtitle')->nullable();
            
            // Kategori Event Section
            $table->boolean('show_categories')->default(true);
            $table->string('categories_title')->default('Kategori Event');
            $table->string('categories_subtitle')->nullable();
            
            // Temukan Event di Kotamu Section
            $table->boolean('show_regions')->default(true);
            $table->string('regions_title')->default('Temukan Event Menarik di Kotamu');
            $table->string('regions_subtitle')->nullable();
            
            $table->timestamps();
        });

        // Insert default settings
        DB::table('homepage_settings')->insert([
            'show_recommended_events' => true,
            'recommended_events_title' => 'Rekomendasi Event',
            'show_nearest_events' => true,
            'nearest_events_title' => 'Event Terdekat',
            'show_upcoming_events' => true,
            'upcoming_events_title' => 'Upcoming Event',
            'show_popular_events' => true,
            'popular_events_title' => 'Popular Event',
            'show_categories' => true,
            'categories_title' => 'Kategori Event',
            'show_regions' => true,
            'regions_title' => 'Temukan Event Menarik di Kotamu',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_settings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('show_in_recommended')->default(false)->after('has_ticket_categories');
            $table->boolean('show_in_nearest')->default(false)->after('show_in_recommended');
            $table->boolean('show_in_upcoming')->default(false)->after('show_in_nearest');
            $table->boolean('show_in_popular')->default(false)->after('show_in_upcoming');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'show_in_recommended',
                'show_in_nearest',
                'show_in_upcoming',
                'show_in_popular'
            ]);
        });
    }
};

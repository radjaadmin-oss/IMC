<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer('sold_count')->default(0)->after('quota');
            $table->integer('views')->default(0)->after('sold_count');
            $table->boolean('is_featured')->default(false)->after('views');
            $table->boolean('is_free')->default(false)->after('is_featured');
            $table->timestamp('early_bird_end')->nullable()->after('date');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['sold_count', 'views', 'is_featured', 'is_free', 'early_bird_end']);
        });
    }
};

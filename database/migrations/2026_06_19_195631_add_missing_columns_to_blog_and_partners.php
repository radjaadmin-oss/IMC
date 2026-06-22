<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('thumbnail')->nullable()->after('content');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->string('url')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('url');
        });
    }
};

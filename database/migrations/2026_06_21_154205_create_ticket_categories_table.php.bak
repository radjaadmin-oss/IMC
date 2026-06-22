<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('ticket_categories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('event_id')->constrained()->onDelete('cascade');
        $table->string('name'); // Early Bird, Presale, Regular, VIP
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2);
        $table->integer('quota');
        $table->integer('sold')->default(0);
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('ticket_categories');
    }
};

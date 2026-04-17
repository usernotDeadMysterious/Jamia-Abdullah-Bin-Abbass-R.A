<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sadqas', function (Blueprint $table) {
            $table->id();

            $table->string('type');       // صدقہ / زکوٰۃ
            $table->integer('amount');    // رقم
            $table->string('donor')->nullable(); // دینے والا
            $table->date('date');         // تاریخ

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sadqas');
    }
};
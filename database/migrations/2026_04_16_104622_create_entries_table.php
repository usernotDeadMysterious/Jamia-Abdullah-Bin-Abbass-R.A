<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();

            $table->date('date');              // تاریخ
            $table->string('name')->nullable(); // نام معاونین
            $table->string('receipt_no')->nullable(); // رسید نمبر
            $table->integer('amount');         // رقم
            $table->string('type');            // صدقہ / زکوٰۃ / خرچ / اشیاء
            $table->text('description')->nullable(); // تفصیل

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
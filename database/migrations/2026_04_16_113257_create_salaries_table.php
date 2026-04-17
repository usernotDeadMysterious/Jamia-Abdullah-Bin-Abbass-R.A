<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();

            $table->string('name');           // نام
            $table->string('designation')->nullable(); // عہدہ

            $table->integer('days')->default(0); // تعداد (دن)
            $table->integer('rate')->default(0); // شرح

            $table->integer('amount')->default(0); // رقم
            $table->integer('allowance')->default(0); // الاونس

            $table->integer('total')->default(0); // کل رقم
            $table->integer('advance')->default(0); // پیشگی
            $table->integer('remaining')->default(0); // بقایا

            $table->integer('month'); // مہینہ
            $table->integer('year');  // سال

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
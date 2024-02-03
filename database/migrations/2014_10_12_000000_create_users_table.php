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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country_code');
            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile')->nullable();
            $table->string('address')->nullable();
            $table->string('kpay_no')->nullable()->default('N/A');
            $table->string('cbpay_no')->nullable()->default('N/A');
            $table->string('wavepay_no')->nullable()->default('N/A');
            $table->string('ayapay_no')->nullable()->default('N/A');
            $table->integer('balance')->default(0);
            $table->integer('commission_balance')->default(0);
            $table->string('user_currency')->default('N/A');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
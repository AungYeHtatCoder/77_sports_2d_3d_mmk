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
        Schema::create('fill_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('kpay_no')->nullable();
            $table->string('cbpay_no')->nullable();
            $table->string('wavepay_no')->nullable();
            $table->string('ayapay_no')->nullable();
            $table->string('user_ph_no');
            $table->string('last_six_digit');
            $table->float('amount');
            // status 0 is pending, 1 is success, 2 is failed
            $table->tinyInteger('status')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill_balances');
    }
};
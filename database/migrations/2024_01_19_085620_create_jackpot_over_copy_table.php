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
        Schema::create('jackpot_over_copy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jackpot_id');
            $table->unsignedBigInteger('two_digit_id');
            // sub amount
            $table->integer('sub_amount')->default(0);
            //prize_sent 
            $table->boolean('prize_sent')->default(false);
            $table->foreign('jackpot_id')->references('id')->on('jackpots')->onDelete('cascade');
            $table->foreign('two_digit_id')->references('id')->on('two_digits')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jackpot_over_copy');
    }
};
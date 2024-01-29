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
        Schema::create('bet_lotteries', function (Blueprint $table) {
            $table->id();
            $table->integer('total_amount')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lottery_match_id')->default(2);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lottery_match_id')->references('id')->on('lottery_matches')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bet_lotteries');
    }
};
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
        Schema::create('bet_lottery_matching', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matching_id');
            $table->unsignedBigInteger('bet_lottery_id');
            $table->string('digit_entry', 3); 
            $table->integer('sub_amount')->default(0);
            $table->boolean('prize_sent')->default(false);
            $table->timestamps();
            $table->foreign('matching_id')->references('id')->on('matchings')->onDelete('cascade');
            $table->foreign('bet_lottery_id')->references('id')->on('bet_lotteries')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bet_lottery_matching');
    }
};
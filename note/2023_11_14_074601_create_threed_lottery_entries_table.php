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
        Schema::create('threed_lottery_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('threed_lottery_id');
            $table->string('digit_entry', 3); // Stores the 3-digit entry as a string
            $table->integer('sub_amount')->default(0);
            $table->boolean('prize_sent')->default(false);
            // Define foreign key for threed_lottery_id
            $table->foreign('threed_lottery_id')->references('id')->on('threed_lotteries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threed_lottery_entries');
    }
};
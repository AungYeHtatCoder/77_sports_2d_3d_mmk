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
        Schema::create('lottery_match_pivot', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('threed_match_time_id');
        $table->unsignedBigInteger('threed_lottery_id');
        $table->string('digit_entry', 3); // Stores the 3-digit entry as a string
        $table->integer('sub_amount')->default(0);
        $table->boolean('prize_sent')->default(false);
        $table->timestamps();
        // Define foreign keys and constraints
        $table->foreign('threed_match_time_id')->references('id')->on('threed_match_times')->onDelete('cascade');
        $table->foreign('threed_lottery_id')->references('id')->on('threed_lotteries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('lottery_match_pivot', function (Blueprint $table) {
        // Replace 'threed_lottery_id' with the actual column name in your pivot table if different
        $table->dropForeign(['threed_lottery_id']); 
    });

    Schema::dropIfExists('lottery_match_pivot');
}

//   public function down()
// {
//     Schema::dropIfExists('match_lottery_pivot');
// }
};
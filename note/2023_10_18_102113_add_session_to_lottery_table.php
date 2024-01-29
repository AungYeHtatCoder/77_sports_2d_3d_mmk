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
        Schema::table('lotteries', function (Blueprint $table) {
        $table->enum('session', ['early-morning','morning', 'early-evening', 'evening'])->after('user_id'); 
        //$table->enum('session', ['morning', 'evening'])->after('user_id'); // 'after' is optional but places the column after user_id for readability
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('lotteries', function (Blueprint $table) {
        $table->dropColumn('session');
    });
    }
};
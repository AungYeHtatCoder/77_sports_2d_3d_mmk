<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('twod_winers_user_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('twod_winer_id');
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('twod_winer_id')
                ->references('id')
                ->on('twod_winers')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('twod_winers_user_pivot');
    }
};
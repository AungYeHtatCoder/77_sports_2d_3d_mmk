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
    Schema::create('three_digits', function (Blueprint $table) {
        $table->id(); // This creates an auto-incrementing primary key column named 'id'.
        $table->char('digit', 3); // 'digit' is a CHAR with a length of 3.
        $table->timestamps(); // This creates 'created_at' and 'updated_at' columns.
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threed_digits');
    }
};
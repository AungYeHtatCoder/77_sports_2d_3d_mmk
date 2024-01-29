<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Jackpot\JackpotLimit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JaktpotLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jackpot_limits')->insert([
            [
                'jack_limit' => '500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
        
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JaktpotMatchSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jackmatches')->insert([
            [
                'match_name' => 'Jackpot',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
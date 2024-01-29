<?php

namespace Database\Seeders;

use App\Models\Admin\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::insert([
            [
                'id'=>1, 
                'name'=>'bath', 
                'rate'=>100, 
                'user_id'=>1
            ],
            [
                'id'=>2, 
                'name' => 'mmk', 
                'rate' => 1,
                'user_id' => 2
            ]
        ]);
    }
}
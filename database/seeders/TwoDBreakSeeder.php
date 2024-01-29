<?php

namespace Database\Seeders;

use App\Models\Admin\ThreeDDLimit;
use App\Models\Admin\TwoDLimit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TwoDBreakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TwoDLimit::create(['two_d_limit'=>"5000"]);
        ThreeDDLimit::create(['three_d_limit' => "5000"]);
    }
}

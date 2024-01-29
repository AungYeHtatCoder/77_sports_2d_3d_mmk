<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Lottery;
use App\Models\Admin\TwoDigit;
use Illuminate\Support\Facades\DB;
class TwoDLotteryPlaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Let's seed for each user
        for ($i = 1; $i <= 5; $i++) {
            // Create a new lottery for the user
            $lottery = Lottery::create([
                'pay_amount' => rand(100, 1000),
                'total_amount' => rand(1000, 5000),
                'user_id' => $i,
                'session' => (rand(0, 1) == 1) ? 'morning' : 'evening',
                'lottery_match_id' => rand(1, 2),  // Assuming you have at least 5 lottery matches
            ]);

            // Attach random two digits to the lottery with sub_amount
            $twoDigitIds = TwoDigit::inRandomOrder()->limit(rand(1, 5))->pluck('id');
            foreach ($twoDigitIds as $twoDigitId) {
                $lottery->twoDigits()->attach($twoDigitId, ['sub_amount' => rand(100, 1000)]);
            }
        }
    }
}
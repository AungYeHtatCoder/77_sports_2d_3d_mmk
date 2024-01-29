<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ThreedMatchTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
        $openTimes = [
            '1: Time',
            '2: Time',
            '3: Time',
            '4: Time',
            '5: Time',
            '6: Time',
            '7: Time',
            '8: Time',
            '9: Time',
            '10: Time',
            '11: Time',
            '12: Time',
            '13: Time',
            '14: Time',
            '15: Time',
            '16: Time',
            '17: Time',
            '18: Time',
            '19: Time',
            '20: Time',
            '21: Time',
            '22: Time',
            '23: Time',
            '24: Time',
        ];

    // Define months and their days
    $months = [
        'January' => 31,
        'February' => 28, // You need to handle leap years separately
        'March' => 31,
        'April' => 30,
        'May' => 31,
        'June' => 30,
        'July' => 31,
        'August' => 31,
        'September' => 30,
        'October' => 31,
        'November' => 30,
        'December' => 31,
    ];

    

        // Adjust February for leap year if necessary
        $year = date('Y');
        if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
            $months['February'] = 29;
        }

        // Loop through each month
        foreach ($months as $month => $days) {
            // Get the date for the 1st and 16th of the month
            $firstOfMonth = Carbon::createFromFormat('F Y', "{$month} {$year}")->startOfMonth();
            $sixteenthOfMonth = clone $firstOfMonth;
            $sixteenthOfMonth->addDays(15);

            // Determine the index for open times
            $firstOpenTimeIndex = ($firstOfMonth->month - 1) * 2;
            $sixteenthOpenTimeIndex = $firstOpenTimeIndex + 1;

            // Insert the entry for the 1st of the month
            DB::table('threed_match_times')->insert([
                'open_time' => $openTimes[$firstOpenTimeIndex],
                'match_time' => $firstOfMonth->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert the entry for the 16th of the month
            DB::table('threed_match_times')->insert([
                'open_time' => $openTimes[$sixteenthOpenTimeIndex],
                'match_time' => $sixteenthOfMonth->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Check for leap year and adjust February if needed
    // $year = date('Y'); // Current year
    // if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
    //     $months['February'] = 29;
    // }

    // $matchDates = [];

    // // Generate the 1st and 16th match dates for each month
    // foreach ($months as $month => $days) {
    //     $matchDates[] = "1 - {$month} - {$year}";
    //     $matchDates[] = "16 - {$month} - {$year}";
    // }

    // // Insert the match dates into the database
    //  foreach ($months as $month => $days) {
    //     DB::table('threed_match_times')->insert([
    //         'open_time' => $openTimes[0], // Assuming "1: Time" for the 1st of each month
    //         'match_time' => Carbon::createFromFormat('F Y', "{$month} {$year}")->startOfMonth()->toDateString(),
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     DB::table('threed_match_times')->insert([
    //         'open_time' => $openTimes[15], // Assuming "16: Time" for the 16th of each month
    //         'match_time' => Carbon::createFromFormat('F Y', "{$month} {$year}")->startOfMonth()->addDays(15)->toDateString(),
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);
    }
    // foreach ($matchDates as $key => $date) {
    //     DB::table('threed_match_times')->insert([
            
    //         'match_time' => $date,
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //         // Assuming 'open_time' is a column in your table, you need to pass a value here
    //     // If 'open_time' should be one of the values from $openTimes based on $key
    //     'open_time' => $openTimes[$key % count($openTimes)], // This will cycle through $openTimes for each $matchDates
    //     ]);
    // }

    // To retrieve the dates
    // $storedMatchTimes = DB::table('threed_match_times')->get();

    // // Format and output the dates
    // foreach ($storedMatchTimes as $matchTime) {
    //     echo $matchTime->match_time . "\n"; // or however you wish to output them
    // }


// Call the function

    //  public function run()
    // {
    //     // Define the match times
    //     $matchTimes = [
    //         '1: Time',
    //         '2: Time',
    //         '3: Time',
    //         '4: Time',
    //         '5: Time',
    //         '6: Time',
    //         '7: Time',
    //         '8: Time',
    //         '9: Time',
    //         '10: Time',
    //         '11: Time',
    //         '12: Time',
    //         '13: Time',
    //         '14: Time',
    //         '15: Time',
    //         '16: Time',
    //         '17: Time',
    //         '18: Time',
    //         '19: Time',
    //         '20: Time',
    //         '21: Time',
    //         '22: Time',
    //         '23: Time',
    //         '24: Time',
    //     ];

    //     // Insert the match times into the database
    //     foreach ($matchTimes as $time) {
    //         DB::table('threed_match_times')->insert([
    //             'match_time' => $time,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }
    // }
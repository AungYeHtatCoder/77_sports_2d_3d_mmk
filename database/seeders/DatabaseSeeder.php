<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            MatchTableSeeder::class,
            TwoDigitsTableSeeder::class,
            //TwoDLotteryPlaySeeder::class,
            ThreeDigitsTableSeeder::class,
            //ThreedMatchTimesTableSeeder::class,
            ThreedMatchTimesTableSeeder::class,

            CountryCodeSeeder::class,
            CurrencySeeder::class,
            //TwoDBreakSeeder::class,
            JaktpotMatchSeederTable::class,
            JaktpotLimitSeeder::class,
            TwoDLimitTableSeeder::class,
            ThreeDLimitTableSeeder::class,
            CommissionTableSeeder::class,
        ]);
    }
}
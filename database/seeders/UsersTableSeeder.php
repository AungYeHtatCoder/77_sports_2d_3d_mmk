<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'           => 'Super Admin',
                'country_code' => "+95",
                'phone'          => '09777710146',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Admin',
                'country_code' => "+95",
                'phone'          => '09690990215',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            
            [
                'name'           => 'Player 2',
                'country_code' => "+95",
                'phone'          => '09334567899',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Player 3',
                'country_code' => "+95",
                'phone'          => '09445647889',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
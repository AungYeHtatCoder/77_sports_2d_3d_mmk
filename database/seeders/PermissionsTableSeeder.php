<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id'         => '1',
                'title'      => 'permission_create',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '2',
                'title'      => 'permission_edit',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '3',
                'title'      => 'permission_show',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '4',
                'title'      => 'permission_delete',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '5',
                'title'      => 'permission_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '6',
                'title'      => 'role_create',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '7',
                'title'      => 'role_edit',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '8',
                'title'      => 'role_show',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '9',
                'title'      => 'role_delete',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '10',
                'title'      => 'role_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '11',
                'title'      => 'user_management_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '12',
                'title'      => 'user_create',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '13',
                'title'      => 'user_edit',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '14',
                'title'      => 'user_show',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '15',
                'title'      => 'user_delete',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '16',
                'title'      => 'user_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],


            [
                'id'         => '17',
                'title'      => 'lottery_match_management_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '18',
                'title'      => 'lottery_match_create',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '19',
                'title'      => 'lottery_match_edit',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '20',
                'title'      => 'lottery_match_show',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '21',
                'title'      => 'lottery_match_delete',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '22',
                'title'      => 'lottery_match_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],


            [
                'id'         => '23',
                'title'      => 'lottery_management_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '24',
                'title'      => 'lottery_create',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '25',
                'title'      => 'lottery_edit',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '26',
                'title'      => 'lottery_show',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '27',
                'title'      => 'lottery_delete',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '28',
                'title'      => 'lottery_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],


            [
                'id'         => '29',
                'title'      => 'two_digit_management_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '30',
                'title'      => 'two_digit_video_create',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '31',
                'title'      => 'two_digit_edit',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '32',
                'title'      => 'two_digit_show',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '33',
                'title'      => 'two_digit_delete',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '34',
                'title'      => 'two_digit_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],

            [
                'id'         => '35',
                'title'      => 'two_d_play_management_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '36',
                'title'      => 'two_d_play_create',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '37',
                'title'      => 'two_d_play_edit',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '38',
                'title'      => 'two_d_play_show',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '39',
                'title'      => 'two_d_play_delete',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '40',
                'title'      => 'two_d_play_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],


             [
                'id'         => '41',
                'title'      => 'two_d_management_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '42',
                'title'      => 'two_d_create',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '43',
                'title'      => 'two_d_edit',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '44',
                'title'      => 'two_d_show',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '45',
                'title'      => 'two_d_delete',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],
            [
                'id'         => '46',
                'title'      => 'two_d_access',
                'created_at' => '2023-02-10 14:00:26',
                'updated_at' => '2023-02-10 14:00:26',
            ],

        ];

        Permission::insert($permissions);
    
    }
}
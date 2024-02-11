<?php

namespace Database\Seeders;

use App\Models\Admin\Role;
use Illuminate\Database\Seeder;
use App\Models\Admin\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin gets all permissions
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        // admin 2 gets all permissions
        //Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        // Master gets specific permissions
        $master_permissions = Permission::whereIn('title', [
            'agent_management_access', 
            'agent_create', 
            'agent_edit', 
            'agent_show', 
            'agent_delete', 
            'agent_access'
        ])->pluck('id');
        Role::findOrFail(2)->permissions()->sync($master_permissions);

        // Agent gets specific permissions
        $agent_permissions = Permission::whereIn('title', [
            'user_management_access', 
            'user_create', 
            'user_edit', 
            'user_show', 
            'user_delete', 
            'user_access'
        ])->pluck('id');
        Role::findOrFail(3)->permissions()->sync($agent_permissions);

        // User does not get any permissions
        // No need to assign permissions to Role 4 (User) as they don't have any
        // $admin_permissions = Permission::all();
        // Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        // $user_permissions = $admin_permissions->filter(function ($permission) {
        //     return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        // });
        // Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
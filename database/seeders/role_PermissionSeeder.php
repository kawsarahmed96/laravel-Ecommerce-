<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class role_PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234567'), //1234567 password
            'remember_token' => Str::random(10),
        ]);

        $super_admin = User::create([
            'name' => 'super admin',
            'email' => 'super@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234567'), //1234567 password
            'remember_token' => Str::random(10),
        ]);

        $superAdminRole = Role::create([
            'name' => 'Super Admin',
        ]);
        $userRole = Role::create([
            'name' => 'user',
        ]);

        $super_admin->assignRole($superAdminRole);

        $user->assignRole($userRole);

        $arrayOfPermissionNames = [
            'edit Role',
            'view role',
            'delete role',
            'add role',
            'add user',
            'delete user',
            'view user',
            'edit user',
            'add product',
            'view product',
            'delete product',
            'edit product',
            'add color',
            'view color',
            'edit color',
            'delete color',
            'add size',
            'view size',
            'edit size',
            'delete size',
            'view catgory',
            'add category',
            'edit category',
            'delete category',
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

    }
}

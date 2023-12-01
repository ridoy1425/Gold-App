<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\EmployeeInfo;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::firstOrCreate([
            'slug' => 'super-admin',
        ], [
            'name' => 'Super Admin',
        ]);

        User::firstOrCreate([
            'name' => 'admin',
            'master_id' => 'admin1234',
            'email' => 'admin@admin.com',
            'phone' => '+880183297787'
        ], [
            'password' => Hash::make('admin'),
            'role_id' => $role->id,
            'email_verified_at' => now(),
            'status' => "active",
        ]);

        $permissions = Permission::whereIn('id', range(1, 100))->get();
        $role->permissions()->sync($permissions);
    }
}

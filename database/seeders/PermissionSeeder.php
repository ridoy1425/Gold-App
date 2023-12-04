<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'Dashboard', 'category' => 'web'],
            ['name' => 'Users', 'category' => 'web'],
            ['name' => 'KYC', 'category' => 'web'],
            ['name' => 'App Settings', 'category' => 'web'],
            ['name' => 'Payments', 'category' => 'web'],
            ['name' => 'Orders', 'category' => 'web'],
            ['name' => 'Collection Request', 'category' => 'web'],
            ['name' => 'Withdraws', 'category' => 'web'],
            ['name' => 'Transfers', 'category' => 'web'],
            ['name' => 'Message Template', 'category' => 'web'],
            ['name' => 'Message To Users', 'category' => 'web'],
            ['name' => 'Support Message', 'category' => 'web'],
            ['name' => 'Role & Permissions', 'category' => 'web'],
            ['name' => 'Website', 'category' => 'web'],
        ];

        // Generating slugs for each permission
        foreach ($permissions as &$permission) {
            $permission['slug'] = Str::slug($permission['name']);
            Permission::firstOrCreate($permission);
        }
    }
}

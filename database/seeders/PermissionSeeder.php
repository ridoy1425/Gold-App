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
            ['name' => 'Designation Label', 'category' => 'general_settings'],
            ['name' => 'Designation Info', 'category' => 'general_settings'],
            ['name' => 'Branch Information', 'category' => 'general_settings'],
            ['name' => 'Leave Type', 'category' => 'general_settings'],

            ['name' => 'Employee Information', 'category' => 'Employees'],

            ['name' => 'Employee Basic Report', 'category' => 'Employee Info Report'],
            ['name' => 'Staff Summary Report', 'category' => 'Employee Info Report'],

            ['name' => 'Leave Entry', 'category' => 'Leave Information'],
            ['name' => 'Leave Approval', 'category' => 'Leave Information'],
            ['name' => 'Leave Application Form', 'category' => 'Leave Information'],

            ['name' => 'Leave Register', 'category' => 'Leave Report'],

            ['name' => 'Appraisal Category', 'category' => 'Appraisal'],
            ['name' => 'Appraisal Evaluator', 'category' => 'Appraisal'],
            ['name' => 'Duty & Responsibilities', 'category' => 'Appraisal'],
            ['name' => 'Attitude & Behavior', 'category' => 'Appraisal'],
            ['name' => 'Evaluation Form', 'category' => 'Appraisal'],

            ['name' => 'Evaluation List', 'category' => 'Appraisal Report'],
            ['name' => 'Appraisal Summary Report', 'category' => 'Appraisal Report'],

            ['name' => 'User List', 'category' => 'User'],
            ['name' => 'Role List', 'category' => 'User'],

        ];

        // Generating slugs for each permission
        foreach ($permissions as &$permission) {
            $permission['slug'] = Str::slug($permission['name']);
            Permission::firstOrCreate($permission);
        }
    }
}

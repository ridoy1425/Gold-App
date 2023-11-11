<?php

namespace Database\Seeders;

use App\Models\Payload;
use Illuminate\Database\Seeder;

class PayloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gender = [
            ['type' => 'gender', 'value' => 'Male',],
            ['type' => 'gender', 'value' => 'Female',],
            ['type' => 'gender', 'value' => 'Others',],
        ];

        $religion = [
            ['type' => 'religion', 'value' => 'Islam',],
            ['type' => 'religion', 'value' => 'Hindu',],
            ['type' => 'religion', 'value' => 'Christian',],
            ['type' => 'religion', 'value' => 'Buddhist',],
            ['type' => 'religion', 'value' => 'Others', ],
        ];

        $marital_status = [
            ['type' => 'marital_status', 'value' => 'Single',],
            ['type' => 'marital_status', 'value' => 'Married',],
            ['type' => 'marital_status', 'value' => 'Separated',],
            ['type' => 'marital_status', 'value' => 'Widow',],
        ];

        $blood_group = [
            ['type' => 'blood_group', 'value' => 'A+',],
            ['type' => 'blood_group', 'value' => 'A-',],
            ['type' => 'blood_group', 'value' => 'B+',],
            ['type' => 'blood_group', 'value' => 'B-',],
            ['type' => 'blood_group', 'value' => 'AB+',],
            ['type' => 'blood_group', 'value' => 'AB-',],
            ['type' => 'blood_group', 'value' => 'O+',],
            ['type' => 'blood_group', 'value' => 'O-',],
        ];

        $degree = [
            ['type' => 'degree', 'value' => 'MSc',],
            ['type' => 'degree', 'value' => 'MA',],
            ['type' => 'degree', 'value' => 'MCom',],
            ['type' => 'degree', 'value' => 'BSc'],
            ['type' => 'degree', 'value' => 'BA'],
            ['type' => 'degree', 'value' => 'BCom',],
            ['type' => 'degree', 'value' => 'HSC'],
            ['type' => 'degree', 'value' => 'SSC'],
            ['type' => 'degree', 'value' => 'JSC'],
            ['type' => 'degree', 'value' => 'PSC'],
        ];

        $age = [
            ['type' => 'age', 'value' => '20'],
            ['type' => 'age', 'value' => '30'],
            ['type' => 'age', 'value' => '40'],
            ['type' => 'age', 'value' => '50'],
            ['type' => 'age', 'value' => '60'],
        ];

        $type = [
            ['type' => 'type', 'value' => 'Permanent',],
            ['type' => 'type', 'value' => 'Contractual', ],
        ];

        $employee_status = [
            ['type' => 'employee_status', 'value' => 'Active', ],
            ['type' => 'employee_status', 'value' => 'Retired',],
            ['type' => 'employee_status', 'value' => 'Resigned',],
            ['type' => 'employee_status', 'value' => 'Contract After Retired',],
        ];

        $leave_status = [
            ['type' => 'status', 'value' => 'Approve',],
            ['type' => 'status', 'value' => 'Cancel',],
            ['type' => 'status', 'value' => 'Pending',],
        ];

        $payload_data = array_merge($gender, $religion, $marital_status, $blood_group, $degree, $age, $type, $employee_status, $leave_status);
        foreach ($payload_data as $data) {
            Payload::firstOrCreate($data);
        }
    }
}

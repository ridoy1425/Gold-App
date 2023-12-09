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

        $marital_status = [
            ['type' => 'marital_status', 'value' => 'Single',],
            ['type' => 'marital_status', 'value' => 'Married',],
            ['type' => 'marital_status', 'value' => 'Separated',],
            ['type' => 'marital_status', 'value' => 'Widow',],
        ];

        $kyc_type = [
            ['type' => 'kyc_type', 'value' => 'National ID card(NID)',],
            ['type' => 'kyc_type', 'value' => 'Passport',],
            ['type' => 'kyc_type', 'value' => 'Birth Certificate',],
            ['type' => 'kyc_type', 'value' => 'School Certificate',],
        ];

        $relation = [
            ['type' => 'relation', 'value' => 'Father',],
            ['type' => 'relation', 'value' => 'Mother',],
            ['type' => 'relation', 'value' => 'Brother',],
            ['type' => 'relation', 'value' => 'Sister',],
            ['type' => 'relation', 'value' => 'Spouse',],
            ['type' => 'relation', 'value' => 'Son',],
            ['type' => 'relation', 'value' => 'Daughter',],
            ['type' => 'relation', 'value' => 'Friend',],
            ['type' => 'relation', 'value' => 'Other',],
        ];

        $mobile_banking = [
            ['type' => 'mobile_banking', 'value' => 'Rocket',],
            ['type' => 'mobile_banking', 'value' => 'Bkash',],
            ['type' => 'mobile_banking', 'value' => 'Nagad',],
        ];

        $status = [
            ['type' => 'status', 'value' => 'Pending',],
            ['type' => 'status', 'value' => 'Active',],
            ['type' => 'status', 'value' => 'Rejected',],
            ['type' => 'status', 'value' => 'Completed',],
            ['type' => 'status', 'value' => 'In Process',],
        ];

        $payload_data = array_merge($gender, $marital_status, $kyc_type, $relation, $mobile_banking, $status);
        foreach ($payload_data as $data) {
            Payload::firstOrCreate($data);
        }
    }
}

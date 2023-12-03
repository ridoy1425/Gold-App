<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'present_house', 'present_house_bn', 'present_post_off', 'present_post_off_bn', 'present_road_no', 'present_road_no_bn', 'present_district', 'present_district_bn', 'permanent_village', 'permanent_village_bn', 'permanent_post_off', 'permanent_post_off_bn', 'permanent_police_station', 'permanent_police_station_bn', 'permanent_district', 'permanent_district_bn'];
}

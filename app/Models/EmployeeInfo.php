<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['employee_gid', 'full_name', 'full_name_bn', 'father_name', 'father_name_bn', 'joining_des_label_id', 'joining_date', 'joining_age', 'present_joining_date', 'present_joining_age', 'appraisal_category_id', 'dob', 'today_age', 'spouse_name', 'spouse_name_bn', 'telephone_no', 'national_id', 'tin_no', 'branch_id', 'present_des_label_id', 'joining_designation_id', 'mobile_no', 'passport_no', 'mother_name', 'mother_name_bn', 'present_designation_id', 'nationality', 'religion_id', 'marital_status_id', 'spouse_nationality', 'alt_mobile_no', 'blood_group_id', 'spouse_occupation', 'gender_id', 'type_id', 'status_id', 'status_date'];

    public function address()
    {
        return $this->hasOne(Address::class, 'employee_id');
    }
    public function academy()
    {
        return $this->hasMany(AcademicInfo::class, 'employee_id');
    }
    public function employment()
    {
        return $this->hasMany(EmploymentInfo::class, 'employee_id');
    }
    public function profession()
    {
        return $this->hasMany(ProfessionalInfo::class, 'employee_id');
    }
    public function training()
    {
        return $this->hasMany(TrainingInfo::class, 'employee_id');
    }
    public function others()
    {
        return $this->hasOne(OtherInfo::class, 'employee_id');
    }
    public function family()
    {
        return $this->hasMany(FamilyMember::class, 'employee_id');
    }
    public function nominee()
    {
        return $this->hasMany(NomineeInfo::class, 'employee_id');
    }

    public function salary()
    {
        return $this->hasOne(SalaryInfo::class, 'employee_id');
    }

    public function promotions()
    {
        return $this->hasMany(PromotionInfo::class, 'employee_id');
    }

    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    public function present_des_label()
    {
        return $this->belongsTo(DesignationLabel::class, 'present_des_label_id', 'id');
    }

    public function joining_des_label()
    {
        return $this->belongsTo(DesignationLabel::class, 'joining_des_label_id');
    }

    public function present_designation()
    {
        return $this->belongsTo(Designation::class, 'present_designation_id');
    }

    public function joining_designation()
    {
        return $this->belongsTo(Designation::class, 'joining_designation_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function religion()
    {
        return $this->belongsTo(Payload::class, 'religion_id', 'id');
    }
    public function marital_status()
    {
        return $this->belongsTo(Payload::class, 'marital_status_id', 'id');
    }
    public function blood_group()
    {
        return $this->belongsTo(Payload::class, 'blood_group_id', 'id');
    }
    public function leaveEntry()
    {
        return $this->hasMany(LeaveEntry::class, 'employee_id');
    }

    public function appraisalCategory()
    {
        return $this->belongsTo(AppraisalCategory::class, 'appraisal_category_id');
    }

    public function appraisal()
    {
        return $this->hasMany(Appraisal::class, 'employee_id');
    }

    public function type()
    {
        return $this->belongsTo(Payload::class, 'type_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Payload::class, 'status_id', 'id');
    }

    public function getAgeAttribute()
    {
        $dob = new \DateTime($this->attributes['dob']);
        $now = new \DateTime();

        $interval = $now->diff($dob);

        return [
            'years' => $interval->y,
            'months' => $interval->m,
            'days' => $interval->d,
        ];
    }

    public function getPresentDesJoiningAgeAttribute()
    {
        $date = new \DateTime($this->attributes['present_joining_date']);
        $now = new \DateTime();

        $interval = $now->diff($date);

        return [
            'years' => $interval->y,
            'months' => $interval->m,
            'days' => $interval->d,
        ];
    }
}

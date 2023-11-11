<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchCategory extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'category_id'];

    public function DutyResponsibility()
    {
        return $this->hasMany(DutyResponsibility::class, 'branch_category_id', 'id');
    }

    public function attitudeBehavior()
    {
        return $this->hasMany(AttitudeBehavior::class, 'branch_category_id', 'id');
    }

    public function hrAdministrative()
    {
        return $this->hasMany(HrAdministrative::class, 'branch_category_id', 'id');
    }

    public function finance()
    {
        return $this->hasMany(Finance::class, 'branch_category_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(AppraisalCategory::class, 'category_id');
    }
}

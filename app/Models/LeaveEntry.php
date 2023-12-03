<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveEntry extends Model
{
    use HasFactory;

    protected $fillable = ['entry_date', 'employee_id', 'leave_type_id', 'leave_from', 'leave_to', 'no_of_days', 'reason', 'leave_address', 'substitute_id', 'accept_from', 'accept_to', 'status_id', 'accepted_no_of_days', 'rejected_reason'];

    public function employee()
    {
        return $this->belongsTo(EmployeeInfo::class, 'employee_id');
    }

    public function substitute()
    {
        return $this->belongsTo(EmployeeInfo::class, 'substitute_id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    public function status()
    {
        return $this->belongsTo(Payload::class, 'status_id');
    }
}

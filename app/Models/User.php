<?php

namespace App\Models;

use App\Traits\RolePermissionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, RolePermissionTrait, HasApiTokens, Notifiable;
    protected $fillable = [
        'name', 'master_id', 'email', 'phone', 'password', 'role_id', 'email_verify_token',
        'status', 'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verify_token'
    ];

    protected $cast = [
        'email_verified_at' => 'datetime',
    ];

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function kyc()
    {
        return $this->hasOne(KycInfo::class, 'user_id');
    }

    public function nominee()
    {
        return $this->hasOne(NomineeInfo::class, 'user_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function bankInfo()
    {
        return $this->hasOne(BankInfo::class, 'user_id');
    }


    public function role()
    {
        return $this->BelongsTo(Role::class, 'role_id');
    }

    public function message()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function transfers()
    {
        return $this->hasMany(PaymentTransfer::class, 'sender_id');
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'user_id');
    }
}

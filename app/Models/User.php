<?php

namespace App\Models;

use App\Traits\RolePermissionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, RolePermissionTrait, HasApiTokens;
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role_id', 'email_verify_token',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $cast = [
        'email_verified_at' => 'datetime',
    ];

    public function kyc()
    {
        return $this->hasOne(KycInfo::class, 'user_id');
    }

    public function nominee()
    {
        return $this->hasOne(NomineeInfo::class, 'user_id');
    }

    public function role()
    {
        return $this->BelongsTo(Role::class, 'role_id');
    }
}

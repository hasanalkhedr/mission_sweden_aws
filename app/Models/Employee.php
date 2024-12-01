<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['id', 'first_name', 'last_name', 'email', 'phone', 'department_id', 'profile_image', 'is_supervisor', 'recieve_email', 'allow_order', 'user_id', 'role', 'position', 'administrativ_residence', 'service'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function missionOrders()
    {
        return $this->hasMany(MissionOrder::class);
    }
    public function tournees()
    {
        return $this->hasMany(Tournee::class);
    }

    public function approvals()
    {
        return $this->hasMany(MissionApprove::class, 'approval_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function managed_departments()
    {
        return $this->hasMany(Department::class);
    }
}


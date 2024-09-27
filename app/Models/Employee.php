<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['full_name', 'email', 'phone', 'department_id', 'user_id', 'role', 'position', 'administrativ_residence', 'service'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function missionOrders()
    {
        return $this->hasMany(MissionOrder::class);
    }

    public function approvals()
    {
        return $this->hasMany(MissionApprove::class, 'approval_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


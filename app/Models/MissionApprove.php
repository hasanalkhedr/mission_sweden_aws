<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionApprove extends Model
{
    protected $fillable = ['mission_order_id', 'approval_id', 'approval_role', 'comment', 'status','memor_status'];

    public function missionOrder()
    {
        return $this->belongsTo(MissionOrder::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'approval_id');
    }
}

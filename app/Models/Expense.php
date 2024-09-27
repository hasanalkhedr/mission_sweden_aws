<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['mission_order_id', 'amount', 'currency', 'description', 'document'];

    public function missionOrder()
    {
        return $this->belongsTo(MissionOrder::class);
    }
}

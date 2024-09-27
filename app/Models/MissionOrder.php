<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class MissionOrder extends Model
{
    protected static function booted() {

        static::creating(function($missionOrder) {
            $missionOrder->order_number = 'MIS-24-'. MissionOrder::max('id')+1;
            $missionOrder->order_date = now();
        });
    }
    protected $fillable = [
        'order_date', 'order_number', 'employee_id', 'purpose', 'description', 'bareme_id',
        'no_meals', 'no_accomodation', 'no_ded_meals', 'no_ded_accomodation', 'start_date', 'end_date',
        'start_time','end_time', 'arrive_location','departure_location','total_amount', 'currency', 'status','charge','ijm'
    ];
    protected $casts = [
        'order_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'string', // Treat time fields as strings
        'end_time' => 'string',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function bareme()
    {
        return $this->belongsTo(Bareme::class);
    }

    public function approvals()
    {
        return $this->hasMany(MissionApprove::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}



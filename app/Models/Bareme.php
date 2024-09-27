<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bareme extends Model
{
    protected static function booted() {

        static::creating(function($bareme) {
            $bareme->meal_cost = round($bareme->pays_per_day * 17.5 /100, 3);
            $bareme->accomodation_cost = round($bareme->pays_per_day * 65/100, 3);
        });
        static::updating(function($bareme) {
            $bareme->meal_cost = round($bareme->pays_per_day * 17.5 /100, 3);
            $bareme->accomodation_cost = round($bareme->pays_per_day * 65/100, 3);
        });
    }
    protected $fillable = ['pays', 'currency', 'pays_per_day', 'meal_cost', 'accomodation_cost'];

    public function missionOrders()
    {
        return $this->hasMany(MissionOrder::class);
    }
}


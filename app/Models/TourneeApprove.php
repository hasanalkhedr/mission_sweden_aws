<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourneeApprove extends Model
{
    protected $fillable = ['tournee_id', 'approval_id', 'approval_role', 'comment', 'status','memor_status'];

    public function tournee()
    {
        return $this->belongsTo(Tournee::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'approval_id');
    }
}

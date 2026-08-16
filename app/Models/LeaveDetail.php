<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_id',
        'start_date',
        'end_date',
        'leave_type',
        'leave_duration',
        'totalday',
    ];

    // Relationship: Each leave detail belongs to a leave request
    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }
}


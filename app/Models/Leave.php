<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'resource_id', 
        'reason_for_leave',
        'status',
    ];

    // Relationship: A leave request can have many leave details (multiple days)
    public function leaveDetails()
    {
        return $this->hasMany(LeaveDetail::class);
    }

    // Optionally, add a relationship to the employee (resource)
    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }
}


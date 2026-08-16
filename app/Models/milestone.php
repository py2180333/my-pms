<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class milestone extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = [
        'project_id', 
        'milestone_name', 
        'milestone_date', 
        'forecasting_date', 
        'status', 
        'description',
        'amount',
        'document',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // pr new 17-9-25
    public function invoice() {
        return $this->hasOne(Invoice::class, 'milestone_id', 'id');
    }
}

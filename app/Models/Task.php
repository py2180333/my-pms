<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'milestone_id',
        'task_name',
        'task_description',
        'status',
        'priority',
        'start_date',
        'end_date',
        'estimated_hours',
        'dependencies',
        'created_by',
        'updated_by',
        'comments'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function milestone()
    {
        return $this->belongsTo(milestone::class);
    }
}


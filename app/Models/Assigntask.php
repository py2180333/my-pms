<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assigntask extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = [
        'project_id',
        'milestone_id',
        'task_id',
        //'assignteam_id',
        'consultant_id',
        'status',
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
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function consultant(){
        //return $this->belongsTo(Resource::class, 'consultant_id')->where('role', 'consultant')->withTrashed();
        return $this->belongsTo(Resource::class, 'consultant_id')->withTrashed(); 
    }
    public function assignteam()
    {
        return $this->belongsTo(assignTeam::class, 'assignteam_id');
    }
    // new -pr 9-7-25
    public function timesheet()
    {
        return $this->hasMany(Timesheet::class, 'assigntask_id');
    }
}

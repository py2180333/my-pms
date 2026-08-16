<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class assignteam extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = [
        'project_id',
        'consultant_id', 
        'status',
        'created_by',
        'updated_by',
        'description'
    ];

    public function consultant()
    {
        return $this->belongsTo(Resource::class, 'consultant_id')->where('role', 'consultant')->withTrashed();

    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}



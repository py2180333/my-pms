<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = ['assigntask_id', 'date', 'hours', 'note', 'status'];

    public function assigntask()
    {
        return $this->belongsTo(Assigntask::class);
    }
}

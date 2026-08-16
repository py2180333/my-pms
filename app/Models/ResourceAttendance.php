<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResourceAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'resource_id',
        'date',
        'check_in',
        'check_out',
        'break_minutes',
        'status',
    ];

    protected $dates = ['check_in', 'check_out'];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
    public function getFormattedCheckInAttribute()
    {
        return $this->check_in ? Carbon::parse($this->check_in)->format('H:i') : 'NA';
    }

    public function getFormattedCheckOutAttribute()
    {
        return $this->check_out ? Carbon::parse($this->check_out)->format('H:i') : 'NA';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = ['holiday_name', 'start_date', 'end_date', 'hours', 'day', 'status'];

    protected $casts = [
        'day' => 'array',
    ];

    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'resource_holiday')
                    ->withTimestamps();
    }
}

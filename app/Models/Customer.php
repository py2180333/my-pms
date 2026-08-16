<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Change to use User for authentication
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait
use Illuminate\Notifications\Notifiable; // new 14-8-25

class Customer extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name',
        'profile_picture', 
        'description', 
        'email', 
        'phone_number', 
        'national_id',
        'address',
        'company_name',
        'company_phone_number', 
        'company_email', 
        'pan_number', 
        'tax_number',
        'password', 
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'customer_company');
    }
}

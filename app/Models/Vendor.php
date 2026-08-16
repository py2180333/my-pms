<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name',
        'profile_picture', 
        'email', 
        'phone_number', 
        'national_id',
        'address', 
        'pan_number', 
        'company_name', 
        'bank_account_no', 
        'account_holder_name', 
        'branch_name', 
        'bank_name', 
        'tax_number', 
        'code_type', 
        'ifsc_code', 
        'swift_code', 
        'website', 
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

    public function VendorCompany(){
        return $this->belongsToMany(Company::class,'companiesvendor');
    }
}


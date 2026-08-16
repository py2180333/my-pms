<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    /**
     * the attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'company_name',
        'email',
        'logo',
        'pan_number',
        'gst_number',
        'phone_number',
        'address',
        'status',
        'bank_account_no',
        'account_holder_name',
        'branch_name',
        'bank_name',
        'ifsc_code',
        'swift_code',
        'iban_code',
        'sign',
        'signname',
        'prefix',
    ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_company');
    }
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'companiesvendor');
    }
    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'companiesresource');
    }
    // pr
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

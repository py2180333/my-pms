<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait

class Project extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes trait

    protected $fillable = [
        'project_name',
        'description',
        'customer_id',
        'vendor_id',
        'company_id',
        'project_manager_id',
        'start_date',
        'end_date',
        'status',
        'project_value',
        'documents',
        'notes',
        'uniquename',
        'currency'
    ];

    protected $casts = [
        'documents' => 'array', // Treat the documents as an array (for JSON handling)
    ];

    // Define relationships
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function manager()
    {
        return $this->belongsTo(Resource::class, 'project_manager_id')->where('role', 'project_manager');

    }
    public function milestones()
    {
        return $this->hasMany(milestone::class);
    }
    // new -pr 24-7-25
    public function assigntask()
    {
        return $this->hasMany(Assigntask::class, 'project_id');
    }
}


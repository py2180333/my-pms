<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // For authentication
use Illuminate\Database\Eloquent\SoftDeletes; // For soft deletion
use Illuminate\Notifications\Notifiable; // new pr 12-8-25

class Resource extends Authenticatable
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
        'birth_date',
        'skills',
        'payment_type',
        'rate',
        'email',
        'phone_number',
        'national_id',
        'address',
        'designation',
        'created_by',
        'updated_by',
        'pan_number',
        'password',
        'username', // Include username in mass assignable fields
        'status',
        'profile_picture',
        'role' // Include role field
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

    /**
     * Generate a unique username using the first three letters of the first name 
     * and the last user ID for uniqueness.
     */
    public static function generateUsername($firstName)
    {
        // Get first 3 characters of first name, and convert to lowercase
        $prefix = strtolower(substr($firstName, 0, 3));

        // Find the max 'id' in the resources table to ensure uniqueness
        $lastId = self::withTrashed()->max('id'); // Consider soft-deleted users as well

        // Increment the ID to avoid conflicts
        $newNumber = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT); // Pad the number to 3 digits

        // Return the combined prefix and unique number
        return $prefix . $newNumber;
    }

    public function ResourceCompany(){
        return $this->belongsToMany(Company::class,'companiesresource');
    }
    public function holidays()
    {
        return $this->belongsToMany(Holiday::class, 'resource_holiday')
                    ->withTimestamps();
    }
    
}

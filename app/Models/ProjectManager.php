<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Change to use User for authentication
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait

class ProjectManager extends Authenticatable
{
    use HasFactory,SoftDeletes;
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
        'pan_number',
        'password',
        'username', // add the username field here
        'status',
        'profile_picture'
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

    // Generate unique username with a global sequence number
    public static function generateUsername($firstName)
    {
        // Get first 3 characters of first name, and convert to lowercase
        $prefix = strtolower(substr($firstName, 0, 3));

        // Get the highest number in the database, extract the last three digits
        $lastManager = self::orderBy('id', 'desc')->first();

        // If no previous manager exists, start with 001
        if ($lastManager) {
            $lastNumber = (int)substr($lastManager->username, 3); // Extract the numeric part from the last username
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Increment the number and pad it to 3 digits
        } else {
            $newNumber = '001';
        }

        // Return the combined prefix and number
        return $prefix . $newNumber;
    }
}

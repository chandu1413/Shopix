<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail; // If you plan to use email verification
use Illuminate\Foundation\Auth\User as Authenticatable; // Extend from Authenticatable for auth features
use Modules\Customer\Database\Factories\CustomerFactory;

class Customer extends Authenticatable   // If you want email verification
{
    use HasFactory, Notifiable;

    protected $table = 'customers'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'mobile_no',
        'photo',
        'is_active',
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
        'is_active' => 'boolean', // Cast is_active to boolean
    ];

    /**
     * The attributes that should be appended to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url', // If you want to add a dynamic attribute for photo URL
    ];

    /**
     * Get the URL for the customer's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->photo ? asset($this->photo) : asset('default-profile.png'); // Adjust default photo path as needed
    }

    /**
     * Define a new factory for the Customer model.
     *
     * @return \Modules\Customer\Database\Factories\CustomerFactory
     */
    // protected static function newFactory(): CustomerFactory
    // {
    //     return CustomerFactory::new();
    // }
}
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Company\Models\Company;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Users\Models\UserDepartment;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'Role',
        'is_admin',
        'org_role',
        'created_by_user_id',
        'company_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function roles(): HasMany
    // {
    //     return $this->hasMany(Role::class);
    // }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    
    public function userDepartments(): HasMany
    {
        return $this->hasMany(UserDepartment::class);
    }

    // getting the user created date and time 
    public function getCreatedAtAttriubute($value){
        return date("d-M-Y",strtotime($value));
    }
}

<?php

namespace Modules\Users\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// use Modules\Users\Database\Factories\UserDepartmentFactory;

class UserDepartment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'department_id',
    ];

    // protected static function newFactory(): UserDepartmentFactory
    // {
    //     // return UserDepartmentFactory::new();
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

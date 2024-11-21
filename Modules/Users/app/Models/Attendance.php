<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Users\Database\Factories\AttendanceFactory;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'user_admin_id',
        'check_in',
        'check_out',
    ];

    // protected static function newFactory(): AttendanceFactory
    // {
    //     // return AttendanceFactory::new();
    // }
}

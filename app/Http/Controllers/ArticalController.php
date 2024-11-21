<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class ArticalController extends Controller implements HasMiddleware
{
    public static function middleware() : array
    {
        return[
            new Middleware('permission:view user', only:['index']),
            new Middleware('permission:edit user', only:['edit']),
            new Middleware('permission:create user', only:['create']),
            new Middleware('permission:destroy user', only:['destroy']),
        ];
    }
}
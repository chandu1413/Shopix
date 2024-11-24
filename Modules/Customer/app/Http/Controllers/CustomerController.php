<?php

namespace Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Customer\Services\CustomerService;
use Modules\Users\Interfaces\UserServiceInterface;
use Modules\Users\Providers\UsersServiceProvider;

class CustomerController extends Controller 
{
    // protected $authService;
    // public function __construct(UserServiceInterface $authService)
    // {
    //     $this->$authService = $userService;
    // } 
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerService = App::make('customer.service');

        $customers =  $customerService->getAllUsers(10);
        // $customers = collect($customersArray);
        // dd($customers);
        return view('customer::customer.index',[
            'customers' => $customers['data'],
            'current_page' => $customers['current_page'],
            'last_page' => $customers['last_page'],
            'per_page' => $customers['per_page'],
            'total' => $customers['total'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('customer::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('customer::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}

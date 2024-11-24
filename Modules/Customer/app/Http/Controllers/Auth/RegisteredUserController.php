<?php

namespace Modules\Customer\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\App;
use Modules\Users\Interfaces\UserServiceInterface;

class RegisteredUserController extends Controller
{
    // protected UserServiceInterface $customerService;

    // public function __construct(UserServiceInterface $customerService)
    // {
    //     $this->customerService = $customerService;
    // }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('customer::auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $customerService = App::make('customer.service');
        // Validate the incoming request
        $validatedData = $this->validateRegistration($request);

        // Create the customer using the service
        $customer = $customerService->createUser($validatedData);

        // Log the customer in
        Auth::login($customer);

        // Trigger the registered event
        event(new Registered($customer));

        // Redirect to the dashboard
        return redirect()->back();
    }


    /**
     * Validate the registration request.
     *
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateRegistration(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:customers,email',
                'lowercase', // Ensure email is stored in lowercase
            ],
            'password' => ['required'],
            'mobile_no' => ['required', 'string', 'max:15'], // Added mobile number validation
        ]);
    }
}

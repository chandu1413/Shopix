<?php

namespace Modules\Customer\Services;

use Modules\Customer\Models\Customer as ModelsCustomer;
use Modules\Users\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerService implements UserServiceInterface
{
    public function handle()
    {
        // This can be implemented as needed
    }

    public function createUser(array $request): ModelsCustomer
    {
        // Validate the request data
        $this->validateUser($request);

        // Handle the photo upload
        // $photoPath = null;
        // if ($request['photo']) {
        //     $photoPath = $request['photo']->store('customer/photos', 'public'); // Store in the 'photos' directory in the 'public' disk
        // }

        // Use mass assignment
        $customer = ModelsCustomer::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']), // Hash the password before saving
            'mobile_no' => $request['mobile_no'],
            'is_active' => 1,
            // 'photo' => $photoPath, // Store the photo path in the database
        ]);

        return $customer;
    }

    public function updateUser(array $request, int $id): ModelsCustomer
    {
        // Find the customer by ID or fail
        $customer = ModelsCustomer::findOrFail($id);

        // Validate the request data
        $this->validateUpdateUser($request, $id);

        // Initialize the photo path to the existing photo
        $photoPath = $customer->photo;

        // Handle the photo upload if a new photo is provided
        if (isset($request['photo']) && $request['photo']) {
            // Store the new photo and get the path
            $photoPath = $request['photo']->store('customer/photos', 'public');
        }

        // Prepare the data for updating
        $updateData = [
            'name' => $request['name'] ?? $customer->name, // Default to existing value if not provided
            'email' => $request['email'] ?? $customer->email, // Default to existing value if not provided
            'mobile_no' => $request['mobile_no'] ?? $customer->mobile_no, // Default to existing value if not provided
            'is_active' => $request['is_active'] ?? $customer->is_active, // Keep existing value if not provided
        ];

        // Conditionally include the photo path if a new photo was uploaded
        if (isset($request['photo']) && $request['photo']) {
            $updateData['photo'] = $photoPath; // Only add the photo key if a new photo is uploaded
        }

        // If the password is provided, hash and add it to the update data
        if (isset($request['password']) && !empty($request['password'])) {
            $updateData['password'] = bcrypt($request['password']);
        }

        // Update the customer record
        $customer->update($updateData);

        return $customer;
    }

    public function deleteUser(int $id): bool
    {
        $customer = ModelsCustomer::findOrFail($id);
        return $customer->delete();
    }

    public function getUser(int $id): ModelsCustomer
    {
        return ModelsCustomer::findOrFail($id);
    }

    public function getAllUsers($perPage = 10) 
{
    // Fetch paginated users
    $users = ModelsCustomer::paginate($perPage);

    // Return the paginated users as an array
    return [
        'data' => $users->items(), // The actual user items
        'current_page' => $users->currentPage(),
        'last_page' => $users->lastPage(),
        'per_page' => $users->perPage(),
        'total' => $users->total(),
    ];
}

    protected function validateUser(array $data, int $id = null): void
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email' . ($id ? ",$id" : '')],
            'mobile_no' => ['required', 'string', 'max:15'], // Adjust the max length as needed
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate the photo
            'password' => ['nullable', 'string', 'min:8'], // Password is optional for updates
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    protected function validateUpdateUser(array $data, int $id = null): void
    {
        $validator = Validator::make($data, [
            'name' => ['string', 'max:255'],
            'email' => [

                'string',
                'email',
                'max:255',
                'unique:customers,email' . ($id ? ",$id" : ''),
            ],
            'mobile_no' => ['string', 'max:15'], // Adjust max length as necessary
            'is_active' => ['nullable', 'boolean'], // Assuming is_active is a boolean
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate the photo
            'password' => ['nullable', 'string', 'min:8' ], // Password is optional for updates
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}

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

    public function createUser (array $data): ModelsCustomer
{
    // Handle the photo upload if needed (commented out in your original code)
    // $photoPath = null;
    // if (isset($data['photo'])) {
    //     $photoPath = $data['photo']->store('customer/photos', 'public');
    // }

    // Use mass assignment
    $customer = ModelsCustomer::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']), // Hash the password before saving
        'mobile_no' => $data['mobile_no'],
        'is_active' => 1,
        // 'photo' => $photoPath, // Store the photo path in the database
    ]);

    return $customer;
}

    public function updateUser(array $request, int $id): ModelsCustomer
    {
        // Find the customer by ID or fail
        $customer = ModelsCustomer::findOrFail($id);
 

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

     

     
}

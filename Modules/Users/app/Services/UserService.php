<?php

namespace Modules\Users\Services;

use Modules\Users\Interfaces\UserServiceInterface;
use app\Models\User;
use GuzzleHttp\Promise\Create;

class UserService implements UserServiceInterface
{
    public function createUser(array $request)
    {

        // Assigning Attributes Manually (Without Mass Assignment
        // Create a new user instance
        // $user = new User;

        // Manually assign each attribute
        // $user->name = $request['name'];
        // $user->email = $request['email'];
        // $user->password = bcrypt($request['password']); // Hash the password before saving

        // Save the user to the database
        // $user->save();

        // return $user;


        //Assigning Attributes with Mass Assignment
        $user = User::create($request);
        return $user;
    }

    
    public function updateUser(array $request, int $id) {

        $user = User::findOrFail($id);
        $user->update($request);
        return $user;

    }


    public function deleteUser(int $id) {
        $user = User::findOrFail($id);
        $user->delete();
        return true;
    }


    public function getUser(int $id) {

        return User::findOrFail($id);
    }
    public function getAllUsers(): array
    {
        // Implementation for getting all users
        return ["User 1", "User 2", "User 3"];
    }
}

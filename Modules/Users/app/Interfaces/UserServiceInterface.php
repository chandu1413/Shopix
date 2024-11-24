<?php

namespace Modules\Users\Interfaces;

interface UserServiceInterface
{
    /**
     * Create a new user.
     *
     * @param array $data User data.
     * @return mixed Returns the created user or a response.
     */
    public function createUser (array $data);

    /**
     * Update an existing user.
     *
     * @param array $data User data to update.
     * @param int $id User ID.
     * @return mixed Returns the updated user or a response.
     */
    public function updateUser (array $data, int $id);

    /**
     * Delete a user by ID.
     *
     * @param int $id User ID.
     * @return bool Returns true if the user was deleted, false otherwise.
     */
    public function deleteUser (int $id);

    /**
     * Get a user by ID.
     *
     * @param int $id User ID.
     * @return mixed Returns the user data or null if not found.
     */
    public function getUser (int $id);

    /**
     * Get all users.
     *
     * @return array Returns an array of users.
     */
    public function getAllUsers();
}
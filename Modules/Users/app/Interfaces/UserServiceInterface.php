<?php

namespace Modules\Users\Interfaces;

interface UserServiceInterface
{
    public function createUser(array $data);
    public function updateUser(array $data, int $id);
    public function deleteUser(int $id);
    public function getUsers(int $id);
}

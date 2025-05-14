<?php
namespace App\Contracts;

use Illuminate\Http\Request;
use App\Models\User;

/**
 * Interface to define the methods to implement later for the UserController
 */
interface UserServiceInterface
{
    public function listUsers(Request $request): mixed;
    public function createUser(Request $request): User;
    public function getUser(string $id): User;
    public function updateUser(Request $request, string $id): User;
    public function deleteUser(string $id): bool;
}

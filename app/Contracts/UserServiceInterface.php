<?php
namespace App\Contracts;

use Illuminate\Http\Request;
use App\Models\User;

/**
 * Interface to define the methods to implement later for the UserController
 */
interface UserServiceInterface
{
    public function listUsers(Request $request);
    public function createUser(Request $request);
    public function getUser(string $id);
    public function updateUser(Request $request, string $id);
    public function deleteUser(string $id): void;
}

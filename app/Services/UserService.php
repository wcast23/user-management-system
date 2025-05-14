<?php
namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    /**
     * Function to List all Users
     * Availabilty to filter by name or email
     */
    public function listUsers(Request $request): mixed
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        return $query->paginate($request->get('per_page', 10));
    }

    /**
     * Function to create a new User
     */
    public function createUser(Request $request): User
    {
        return User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);
    }

    /**
     * Function to retrieve a user by its id.
     */
    public function getUser(string $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * Function to update a User based on its id.
     */
    public function updateUser(Request $request, string $id): User
    {
        $user = User::findOrFail($id);

        $user->update([
            'name'         => $request->name ?? $user->name,
            'email'        => $request->email ?? $user->email,
            'password'     => $request->password ? Hash::make($request->password) : $user->password,
            'phone_number' => $request->phone_number ?? $user->phone_number,
        ]);

        return $user;
    }

    /**
     * Function to remove a User by providing its id.
     */
    public function deleteUser(string $id): bool
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}

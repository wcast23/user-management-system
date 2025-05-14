<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function listUsers(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->name($request->name); // Scope definido en el modelo
        }

        if ($request->filled('email')) {
            $query->email($request->email); // Scope definido en el modelo
        }

        if ($request->filled('sort_by') && in_array($request->sort_by, ['name', 'email'])) {
            $dir = $request->get('sort_dir', 'asc') === 'desc' ? 'desc' : 'asc';
            $query->orderBy($request->sort_by, $dir);
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function createUser(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);
    }

    public function getUser(string $id)
    {
        return User::findOrFail($id);
    }

    public function updateUser(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name'         => $request->name ?? $user->name,
            'email'        => $request->email ?? $user->email,
            'password'     => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'phone_number' => $request->phone_number ?? $user->phone_number,
        ]);

        return $user;
    }

    public function deleteUser(string $id):void
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}

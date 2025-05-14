<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\QueryFilters\UserFilter;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserFilter $filters)
    {
        $query = $filters->apply(User::query());

        // Applying Optional sorting by name and email
        if ($request->filled('sort_by') && in_array($request->sort_by, ['name', 'email'])) {
            // Applying Optional sorting by names in ascending or descending order.
            $dir = $request->get('sort_dir', 'asc') === 'desc' ? 'desc' : 'asc';
            $query->orderBy($request->sort_by, $dir);
        }

        /**
         * Applying pagination, currently set to 10 by default
        */
        return response()->json(
            $query->paginate($request->get('per_page', 10))
        );
    }

    /**
     * Create a new User.
     */
    public function store(Request $request)
    {
        /**
         * Request Validation Applied to make sure the data
         * Received from the client is Accurate and valid
         * Prior to save it in the database
        */
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:15',
        ]);

        // Create the user after data has been validated.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptar la contraseña
            'phone_number' => $request->phone_number,
        ]);

        /**
         * Returning a code to prove the transaction was succesful.
        */
        return response()->json($user, 201);
    }

    /**
     * Display a specific user.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Function to update an user.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'phone_number' => 'sometimes|required|string|max:15',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'phone_number' => $request->phone_number ?? $user->phone_number,
        ]);

        return response()->json($user);
    }

    /**
     * Remove the specified user from the database.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}

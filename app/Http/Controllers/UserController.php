<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\QueryFilters\UserFilter;
use App\Http\Resources\UserResource;
use App\Contracts\UserServiceInterface;

class UserController extends Controller
{
    public function __construct(private UserServiceInterface $userService) {}

    public function index(Request $request)
    {
        $users = $this->userService->listUsers($request);
        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8',
            'phone_number' => 'required|string|max:15',
        ]);

        $user = $this->userService->createUser($request);
        return new UserResource($user);
    }

    public function show(string $id)
    {
        $user = $this->userService->getUser($id);
        return new UserResource($user);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
        ]);

        $user = $this->userService->updateUser($request, $id);
        return new UserResource($user);
    }

    public function destroy(string $id)
    {
        $this->userService->deleteUser($id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}

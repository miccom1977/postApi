<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        if (Gate::allows('is_admin')) {
            $users = User::paginate(5);
            return UserResource::collection($users);
        }
        return abort(403, 'Bad permission');
    }

    public function show(User $user): UserResource
    {
        if (Gate::allows('is_admin')) {
            return new UserResource($user);
        }
        return abort(403, 'Bad permission');
    }

    public function update(UserRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        if (Gate::allows('is_admin')) {
            // Tylko admin ma dostęp do edycji usera
            $user->update($request->all());
            return response()->json(['message' => 'User updated']);
        }
        return abort(403, 'Bad permission');
    }

    public function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        if (Gate::allows('is_admin')) {
            // Tylko admin ma dostęp do usunięcia usera
            $user->delete();
            return response()->json(['message' => 'User deleted'], 200);
        }
        return abort(403, 'Bad permission');
    }
}

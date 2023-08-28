<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserResource;
use App\Jobs\SendRegistrationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    protected function create(UserRegistrationRequest $request)
    {
        if (Gate::allows('is_admin')) {
            // Tworzenie nowego użytkownika w bazie danych na podstawie danych z żądania
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'user'
            ]);
            dispatch(new SendRegistrationEmail($user));
            return new UserResource($user);
        }
        return abort(403, 'Bad permission');
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\JsonResponses\Auth\LoginResponse;
use App\Http\JsonResponses\Auth\RegisterResponse;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * @group Authentication
 *
 * APIs for managing authentication
 */
class AuthController extends Controller
{

    /**
     * Handle user registration.
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request) : JsonResponse
    {
        return new RegisterResponse(
            User::create($request->validated())
        );
    }

    /**
     * Handle an authentication attempt.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request) : JsonResponse
    {
        $credentials = $request->validated();

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid user credentials'
            ], 401);
        }

        return new LoginResponse(
            User::where('email', $request->email)->first()
        );
    }
}

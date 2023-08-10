<?php

namespace App\Http\JsonResponses\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class LoginResponse extends JsonResponse
{
    /**
     * CreateResponse constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $token  = $user->createToken('auth_token')->plainTextToken;
        parent::__construct([
            'user' => $user,
            'token' => $token,
        ]);
    }
}

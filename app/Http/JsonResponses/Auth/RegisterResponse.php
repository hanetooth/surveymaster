<?php

namespace App\Http\JsonResponses\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterResponse extends JsonResponse
{
    /**
     * CreateResponse constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $token  = $user->createToken('auth_token')->plainTextToken;
        parent::__construct([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private readonly User $user,
    )
    {

    }
    public function login(AuthRequest $request): JsonResponse
    {
        $user = $this->user->where('email', $request['email'])->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);

        }
        $token = $user->createToken('auth_token', [$user['role']])->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'role' => $user['role'],
        ],200);
    }

}

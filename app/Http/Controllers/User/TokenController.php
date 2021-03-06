<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\TokenStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller
{
    public function store(TokenStoreRequest $request)
    {
        /** @var User $user */
        $user = User::query()->firstWhere('email', $request->input('email'));

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json(null, Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'access_token' => $user->createToken('')->plainTextToken,
        ]);
    }

    public function destroy()
    {
        /** @var User $user */
        $user = Auth::user();

        $user->tokens()->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

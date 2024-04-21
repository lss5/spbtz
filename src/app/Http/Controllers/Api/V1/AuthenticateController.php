<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Services\User\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function registration(Request $request): JsonResponse
    {
        $registerRequest = new RegisterRequest();
        $validator = Validator::make($request->all(), $registerRequest->rules());

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        }

        $user = $this->service->store($request);

        return response()->json([
            'error' => null,
            'result' => [
                'access_token' => $user->createToken('auth-token', ['*'], now()->addWeek())->plainTextToken,
            ],
        ]);
    }

    public function authenticate(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'login' => ['required'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        }

        if (Auth::attempt($validator->validated())) {
            return response()->json([
                'error' => null,
                'result' => [
                    'access_token' => Auth::user()->createToken('auth-token', ['*'], now()->addWeek())->plainTextToken,
                ],
            ]);
        }

        return response()->json([
            'error' => 'Неверный логин или пароль',
            'result' => null,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(Request $request)
    {
        if ($request->ajax()) {

            $request->validate([
                'id' => ['required', 'integer'],
            ]);

            $user = User::find($request->id);

            if ($user) {
                return new UserResource($user);
            }

            return response()->json([
                'error' => 'Пользователь не найден',
                'result' => null,
            ]);
        }
    }

}

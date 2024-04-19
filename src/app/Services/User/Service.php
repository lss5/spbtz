<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Service
{
    public function store($data): User
    {
        $user = User::create([
            'login' => $data['login'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'password' => Hash::make($data['password']),
            'date_birthday' => $data['date_birthday'],
        ]);

        return $user;
    }
}
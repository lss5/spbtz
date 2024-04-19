<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'max:64', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_birthday' => ['nullable', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Поле Логин обязательно для заполнения',
            'login.unique' => 'Данный логин уже занят, введите другой',
            'password.required' => 'Поле Пароль обязательно для заполнения',
            'password.min' => 'Необходимо минимальное количество символов',
            'password.confirmed' => 'Проверьте правильность ввода пароля',
            'first_name' => 'Поле Имя обязательно для заполнения',
            'last_name' => 'Поле Фамилия обязательно для заполнения',
            'date_birthday' => 'Значение в поле Дата рождения должно быть датой',
        ];
    }
}

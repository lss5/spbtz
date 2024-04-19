<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле Заголовок обязательно для заполнения',
            'description.required' => 'Поле Описание обязательно для заполнения',
        ];
    }
}

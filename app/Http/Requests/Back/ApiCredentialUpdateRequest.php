<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class ApiCredentialUpdateRequest extends FormRequest
{
    /**
     * check if user is logged in and is  admin
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'url'=>'required|max:50|url',
            'key'=>'required|string|max:50'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'url.required'=>'API endpoint is required',
            'url.max'=>'API endpoint is too long,max:50',
            'url.url'=>'Invalid url',
            'key.required'=>'API key is required',
            'key.max'=>'API key is too long,max:50',
            'key.string'=>'Invalid key',
        ];
    }
}
<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules()
    {
        return [
            'name'=>'required|string|max:20',
            'description'=>'nullable|string|max:200',
            'metaTitle'=>'nullable|string|max:50',
            'metaDescription'=>'nullable|string',
            'email'=>'required|email|max:20',
            'contact'=>'required|string|max:20',
            'address'=>'required|string|max:50',
        ];
    }
}
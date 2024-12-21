<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'We need to know your email address!',
            'password.required' => 'Please provide a password.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new Response(['error' => $validator->errors()->messages()],  Response::HTTP_UNPROCESSABLE_ENTITY);
        throw new ValidationException($validator,  $response);
    }
}

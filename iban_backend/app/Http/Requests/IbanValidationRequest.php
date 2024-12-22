<?php

namespace App\Http\Requests;

use App\Helper\Validation\IbanValidationHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class IbanValidationRequest extends FormRequest
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
            'iban' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'iban.required' => trans('validation-message.iban_is_required'),
        ];
    }

    public function withValidator(Validator $validator)
    {
        $iban = $this->input('iban');
        if($iban) {
            $validationResult = IbanValidationHelper::validateIBAN($iban);
        
            $validator->after(function ($validator) use($validationResult){
                if (!$validationResult->success) {
                    $validator->errors()->add('iban', $validationResult->message);
                }
            });
        }
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new Response(['error' => $validator->errors()->messages()],  Response::HTTP_UNPROCESSABLE_ENTITY);
        throw new ValidationException($validator,  $response);
    }
}

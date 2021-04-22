<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->path() == 'api/register') {
            return [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|confirmed|min:6',
                'date_of_birth' => 'required|date|date_format:d-m-Y',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ];
        }
    }

    public function messages()
    {
        return [
            // 
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()->first(),
                    'data' => null
                ],
                400
            )
        );
    }
}

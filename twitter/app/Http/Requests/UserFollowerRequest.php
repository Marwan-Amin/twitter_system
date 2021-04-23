<?php

namespace App\Http\Requests;

use App\Rules\ValidateNotFollowingUser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserFollowerRequest extends FormRequest
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
        return [
            'user_id' => ['required', 'integer', 'min:0', 'exists:users,id', 'not_in:' . auth()->user()->id, new ValidateNotFollowingUser]
        ];
    }

    public function messages()
    {
        return [
            'user_id.not_in' => __('user.current_user_id')
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

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RouteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nickname' => ['nullable', 'min:2'],
            'domain_name' => ['required', 'unique:routes,domain_name', 'regex:/^(([^:\/?#]*)(?:\:([0-9]+))?)$/'],
            'host' => ['required', 'regex:/^([0-9]{1,3}(\.[0-9]{1,3}){3}):[0-9]{1,5}/'],
            'group_id' => ['nullable', 'exists:groups,id', 'numeric']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $messages = $validator->getMessageBag();
        foreach ($messages->all() as $message) {
            notyf()->addError($message);
        }
        throw new HttpResponseException(back()->withInput()); // Dont give http error response because we need to display the error as a flash notification
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GroupRequest extends FormRequest
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
            'name' => ['required', 'unique:groups,name,'. $this->segment(2)],
            'description' => 'required'
        ];
    }

    /**
     * Overwrite failedValidation method
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $messages = $validator->getMessageBag();
        foreach ($messages->all() as $message) {
            notyf()->addError($message);
        }
        throw new HttpResponseException(back()->withInput()); // Dont give http error response because we need to display the error as a flash notification
    }
}

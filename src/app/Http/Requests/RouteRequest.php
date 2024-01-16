<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nickname' => ['required', 'min:2'],
            'domain_name' => ['required', 'unique:routes,domain_name', 'regex:/^(([^:\/?#]*)(?:\:([0-9]+))?)$/'],
            'host' => ['required', 'ipv4'],
            'group_id' => ['exists:groups,id', 'numeric']
        ];
    }
}

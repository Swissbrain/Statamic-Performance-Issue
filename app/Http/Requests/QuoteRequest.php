<?php

namespace App\Http\Requests;

use App\Models\Auth\User;
use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'integer|required',
            'company' => 'string|nullable',
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'street' => 'string|required',
            'zip_code' => 'integer|required|min:1000|max:9999',
            'city' => 'string|required',
            'email' => 'email|required',
            'phone' => 'string|nullable',
            'terms' => 'accepted',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

<?php

namespace App\Http\Requests\AuthApi;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawRequest extends FormRequest
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
            'payment_method' => 'required',
            'amount' => 'required|numeric',
            'phone' => 'required|numeric',
            'name' => 'required|string',
            'currency' => 'required',
        ];
    }
}

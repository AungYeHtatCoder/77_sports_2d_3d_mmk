<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThreedPlayRequest extends FormRequest
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
    public function rules()
        {
            return [
                'totalAmount' => 'required|numeric|min:1',
                'amounts' => 'required|array',
                'amounts.*.num' => 'required|integer',
                'amounts.*.amount' => 'required|integer|min:1',
            ];
        }
}
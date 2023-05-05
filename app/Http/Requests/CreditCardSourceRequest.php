<?php

namespace App\Http\Requests;

use App\Rules\CreditCardExpirationRule;
use App\Rules\CreditCardNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class CreditCardSourceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'card_number' => ['required', new CreditCardNumberRule],
            'expiration_date' => ['required', new CreditCardExpirationRule],
            'amount' => 'required',
            'cvv' => 'required|max:3|min:3',
        ];
    }
}

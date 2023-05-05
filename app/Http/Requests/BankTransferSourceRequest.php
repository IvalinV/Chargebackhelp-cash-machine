<?php

namespace App\Http\Requests;

use App\Rules\BankTranferDateRule;
use Illuminate\Foundation\Http\FormRequest;

class BankTransferSourceRequest extends FormRequest
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
            'transfer_date' => [new BankTranferDateRule],
            'customer_name' => 'required',
            'account_number' => 'required',
            'amount' => 'required',
        ];
    }
}

<?php

namespace App\Transactions;

use App\Interfaces\Transaction;
use App\Rules\CreditCardNumberRule;
use App\Rules\CreditCardExpirationRule;
use Illuminate\Support\Facades\Validator;

class CreditCardTransaction implements Transaction
{
    private $cardNumber;
    private $expirationDate;
    private $cardholder;
    private $cvv;
    private $amount;

    public function __construct($data)
    {
        $this->cardNumber = $data['card_number'];
        $this->expirationDate = $data['expiration_date'];
        $this->cardholder = $data['cardholder'];
        $this->cvv = $data['cvv'];
        $this->amount = $data['amount'];
    }

    /**
     * Validate request data.
     *
     * @return \Illuminate\Support\Facades\Validator $validator
     */
    public function validate()
    {
        $validator = Validator::make($this->inputs(), [
            'card_number' => ['required', 'min:6','max:6', new CreditCardNumberRule()],
            'expiration_date' => ['required', new CreditCardExpirationRule()],
            'amount' => 'required',
            'cvv' => 'required|max:3|min:3',
        ]);

        if($validator->fails()) {
            return $validator;
        }

        return true;
    }

    /**
     * Calculate amoutn.
     *
     * @return array $amount
     */
    public function amount()
    {
        return array_sum($this->inputs());
    }

    /**
     * Return class fileds.
     *
     * @return array $inputs
     */
    public function inputs()
    {
        return [
            'card_number' => $this->cardNumber,
            'expiration_date' => $this->expirationDate,
            'cardholder' => $this->cardholder,
            'cvv' => $this->cvv,
            'amount' => $this->amount
        ];
    }
}

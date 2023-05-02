<?php

namespace App\Transactions;

use App\Interfaces\Transaction;
use App\Rules\CreditCardExpirationRule;
use App\Rules\CreditCardNumberRule;
use Illuminate\Support\Facades\Validator;

class CreditCardTransaction implements Transaction
{

    private $card_number;
    private $expiration_date;
    private $cardholder;
    private $cvv;
    private $amount;


    public function __construct($data)
    {
        $this->card_number = $data['card_number'];
        $this->expiration_date = $data['expiration_date'];
        $this->cardholder = $data['cardholder'];
        $this->cvv = $data['cvv'];
        $this->amount = $data['amount'];
    }

    public function validate()
    {
        $validator = Validator::make($this->inputs(), [
            'card_number' => ['required', new CreditCardNumberRule],
            'expiration_date' => ['required', new CreditCardExpirationRule],
            'amount' => 'required',
            'cvv' => 'required|max:3|min:3',
        ]);

        if($validator->fails())
        {
            return $validator;
        }

        return true;
    }

    public function amount()
    {
        return array_sum($this->inputs());
    }

    public function inputs()
    {
        return [
            'card_number' => $this->card_number,
            'expiration_date' => $this->expiration_date,
            'cardholder' => $this->cardholder,
            'cvv' => $this->cvv,
            'amount' => $this->amount
        ];
    }
}

<?php

namespace App\Transactions;

use App\Interfaces\Transaction;
use App\Rules\BankTranferDateRule;
use Illuminate\Support\Facades\Validator;

class BankTransferTransaction implements Transaction
{
    private $transfer_date;
    private $customer_name;
    private $account_number;
    private $amount;

    public function __construct($data)
    {
        $this->transfer_date = $data['transfer_date'];
        $this->customer_name = $data['customer_name'];
        $this->account_number = $data['account_number'];
        $this->amount = $data['amount'];
    }

    public function validate()
    {
        $validator = Validator::make($this->inputs(), [
            'transfer_date' => [new BankTranferDateRule],
            'customer_name' => 'required',
            'account_number' => 'required',
            'amount' => 'required',
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
            'transfer_date' => $this->transfer_date,
            'customer_name' => $this->customer_name,
            'account_number' => $this->account_number,
            'amount' => $this->amount,
        ];
    }
}

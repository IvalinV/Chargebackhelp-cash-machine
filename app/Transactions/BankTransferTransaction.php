<?php

namespace App\Transactions;

use App\Interfaces\Transaction;
use App\Rules\BankTranferDateRule;
use Illuminate\Support\Facades\Validator;

class BankTransferTransaction implements Transaction
{
    private $transferDate;
    private $customerName;
    private $accountNumber;
    private $amount;

    public function __construct($data)
    {
        $this->transferDate = $data['transfer_date'];
        $this->customerName = $data['customer_name'];
        $this->accountNumber = $data['account_number'];
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
            'transfer_date' => [new BankTranferDateRule()],
            'customer_name' => 'required',
            'account_number' => 'required|max:',
            'amount' => 'required',
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
            'transfer_date' => $this->transferDate,
            'customer_name' => $this->customerName,
            'account_number' => $this->accountNumber,
            'amount' => $this->amount,
        ];
    }
}

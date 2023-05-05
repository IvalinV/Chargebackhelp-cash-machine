<?php

namespace App\Transactions;

use App\Interfaces\Transaction;
use Illuminate\Support\Facades\Validator;

class CashTransaction implements Transaction
{
    private $oneBills;
    private $fiveBills;
    private $tenBills;
    private $fiftyBills;
    private $hundredBills;

    public function __construct($data)
    {
        $this->oneBills = $data['one_bills'];
        $this->fiveBills = $data['five_bills'];
        $this->tenBills = $data['ten_bills'];
        $this->fiftyBills = $data['fifty_bills'];
        $this->hundredBills = $data['hundred_bills'];
    }

    /**
     * Validate request data.
     *
     * @return \Illuminate\Support\Facades\Validator $validator
     */
    public function validate()
    {
        $validator = Validator::make($this->inputs(), [
            'one_bills' => 'required',
            'five_bills' => 'required',
            'ten_bills' => 'required',
            'fifty_bills' => 'required',
            'hundred_bills' => 'required',
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
           'one_bills' => $this->oneBills,
           'five_bills' => $this->fiveBills,
           'ten_bills' => $this->tenBills,
           'fifty_bills' => $this->fiftyBills,
           'hundred_bills' => $this->hundredBills
        ];
    }
}

<?php

namespace App\Transactions;

use App\Interfaces\Transaction;
use App\Models\CashSource;
use Illuminate\Support\Facades\Validator;

class CashTransaction implements Transaction
{
     private $one_bills;
     private $five_bills;
     private $ten_bills;
     private $fifty_bills;
     private $hundred_bills;

    public function __construct($data)
    {
        $this->one_bills = $data['one_bills'];
        $this->five_bills = $data['five_bills'];
        $this->ten_bills = $data['ten_bills'];
        $this->fifty_bills = $data['fifty_bills'];
        $this->hundred_bills = $data['hundred_bills'];
    }

    public function validate()
    {
        $validator = Validator::make($this->inputs(), [
            'one_bills' => 'required',
            'five_bills' => 'required',
            'ten_bills' => 'required',
            'fifty_bills' => 'required',
            'hundred_bills' => 'required',
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
           'one_bills' => $this->one_bills,
           'five_bills' => $this->five_bills,
           'ten_bills' => $this->ten_bills,
           'fifty_bills' => $this->fifty_bills,
           'hundred_bills' => $this->hundred_bills
        ];
    }
}

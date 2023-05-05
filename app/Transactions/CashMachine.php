<?php

namespace App\Transactions;

use App\Models\CashSource;
use App\Interfaces\Transaction;
use App\Models\Transaction as TransactionModel;
use App\Models\BankTranferSource;
use App\Models\CreditCardSource;

class CashMachine
{
    /**
     * Store transaction to the database.
     *
     * @param Transaction $transaction
     * @return void
     */
    public function store(Transaction $transaction)
    {
        $source = $this->getModel(get_class($transaction));
        $validation = $transaction->validate();

        if(!is_bool($validation)) {
            return $transaction->validate();
        } else {
            $this->storeTransaction($transaction, $source);
        }
    }

    /**
     * Get Laravel model for the transaction.
     *
     * @param string $class
     * @return void
     */
    public function getModel($class)
    {
        switch ($class) {
            case 'App\\Transactions\\CashTransaction':
                return new CashSource();
            case 'App\\Transactions\\BankTransferTransaction':
                return new BankTranferSource();
            case 'App\\Transactions\\CreditCardTransaction':
                return new CreditCardSource();
        }
    }

    /**
     * Store transaction if possible.
     *
     * @param Transaction $transaction
     * @param Illuminate\Database\Eloquent\Model $source
     * @return void
     */
    public function storeTransaction($transaction, $source)
    {
        $amount = $this->calculateTransactionAmount($transaction);
        $transactionsTotalAmount = $this->calculateTotalAmount();
        $cashMachineTotalAmount = config('transactions.total_amount');

        if ($amount > $cashMachineTotalAmount || $transactionsTotalAmount > $cashMachineTotalAmount) {
            return ['Total Limit Exceded'];
        }

        TransactionModel::create([
            'inputs' => json_encode($transaction->inputs()),
            'total_amount' => $amount
        ]);
    }

    /**
     * Calculate the total amount of transaction in the database.
     *
     * @return int $total_amount
     */
    public function calculateTotalAmount()
    {
        $cash = CashSource::sum('total_amount');
        $card = CreditCardSource::sum('total_amount');
        $tranfer = BankTranferSource::sum('total_amount');

        return $cash + $card + $tranfer;
    }

    public function calculateTransactionAmount($transaction)
    {
        if (get_class($transaction) === 'App\Transactions\CashTransaction') {
            return array_sum($transaction->inputs());
        }
        return $transaction->inputs()['amount'];
    }
}

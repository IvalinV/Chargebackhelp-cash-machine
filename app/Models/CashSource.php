<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashSource extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $castst = ['inputs' => 'json'];
    /**
     * Check if the total amount for the Cash Source is exceded.
     *
     * @return void
     */
    public function totalAmountЕxceeded()
    {
        return $this->all()->sum() > 10000;
    }
}

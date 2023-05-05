<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTranferSource extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $castst = ['inputs' => 'json'];

}

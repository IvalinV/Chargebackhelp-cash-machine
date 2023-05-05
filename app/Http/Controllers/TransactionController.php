<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Transactions\CashMachine;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Methods/Index',[
            'transactions' => Transaction::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Methods/Transactions');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'source' => 'required|string|in:Cash,BankTransfer,CreditCard'
        ]);
        
        $type = $validated['source'];
        $class = "App\\Transactions\\$type"."Transaction";
        $source = new $class($request->all());

        $response = (new CashMachine)->store($source);
        return redirect()->back()->withErrors($response);
    }
}

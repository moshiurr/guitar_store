<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::all();
    }

    public function store(TransactionRequest $request)
    {
        return Transaction::create($request->validated());
    }

    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());

        return $transaction;
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json();
    }
}

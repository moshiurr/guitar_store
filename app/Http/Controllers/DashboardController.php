<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\TransactionServices;
use Carbon\Carbon;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(TransactionServices $transactionServices)
    {

        $transactions = $transactionServices->getTransactions(auth()->user()->id);

        return Inertia::render('Dashboard',[
            'name' => 'John Doe',
            'date' => Carbon::now()->format('l, d F Y'),
            'budget' => '5000',
            'total_expenses' => $transactions['total_expenses'],
            'recent_transactions' => $transactions['recent_transactions'],
        ]);
    }
}

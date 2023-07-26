<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionServices
{
    public function __construct()
    {

    }

    public function getTransactions($user_id)
    {
        $query = Transaction::select('id', 'price', 'description', 'created_at', 'type')
                            ->where('user_id', $user_id)
                            ->whereYear('created_at', date('Y'))
                            ->whereMonth('created_at', date('m'));

        $transactions = $query->get();
        $expenditure = round($query->sum('price'),2);

        return [
            'total_expenses' => $expenditure,
            'recent_transactions' => $transactions
        ];
    }
}

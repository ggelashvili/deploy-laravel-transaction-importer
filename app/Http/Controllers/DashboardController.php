<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(TransactionService $transactionService): View
    {
        $stats = $transactionService->getTransactionStats();

        return view('dashboard', [
            'stats' => [
                [
                    'title'     => 'Total Transactions',
                    'value'     => $stats['total_transactions'],
                    'formatted' => number_format($stats['total_transactions']),
                ],
                [
                    'title'     => 'Total Income',
                    'value'     => $stats['total_income'],
                    'formatted' => '$' . number_format($stats['total_income']),
                    'colored'   => true,
                ],
                [
                    'title'     => 'Total Expense',
                    'value'     => $stats['total_expense'],
                    'formatted' => '-$' . number_format(abs($stats['total_expense'])),
                    'colored'   => true,
                ],
                [
                    'title'     => 'Net Income',
                    'value'     => $stats['net_income'],
                    'formatted' => '$' . number_format(abs($stats['net_income'])),
                    'colored'   => true,
                ],
            ],
        ]);
    }
}

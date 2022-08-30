<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function importFromCsv(string $filePath): void
    {
        if (! file_exists($filePath)) {
            throw new \RuntimeException('Failed to process import. File not found.');
        }

        $handle = fopen($filePath, 'r');

        // discard first line
        fgetcsv($handle);

        DB::transaction(function () use ($handle) {
            while (($line = fgetcsv($handle)) !== false) {
                [$transactionId, $amount, $date, $description] = $line;

                $date   = Carbon::createFromFormat('m/d/Y H:i:s', $date);
                $amount = str_replace([',', '$'], '', $amount);

                Transaction::create(
                    [
                        'transaction_id'   => $transactionId,
                        'amount'           => $amount * 100,
                        'description'      => $description,
                        'transaction_date' => $date,
                    ]
                );
            }
        });
    }

    public function getTransactionStats(): array
    {
        return (array) DB::table((new Transaction())->getTable())->selectRaw(
            'COUNT(id) AS total_transactions,
             SUM(amount) AS net_income,
             SUM(IF(amount < 0, amount, 0)) AS total_expense,
             SUM(IF(amount > 0, amount, 0)) AS total_income'
        )->first();
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ImportController extends Controller
{
    public function __invoke(Request $request, TransactionService $transactionService): RedirectResponse
    {
        $request->validate(['importFile' => ['required', 'file']]);

        $file = $request->file('importFile');

        if ($file->getClientOriginalExtension() !== 'csv' && $file->getExtension() !== 'txt') {
            throw ValidationException::withMessages(['Please select a "csv" file.']);
        }

        $fileId = Str::uuid();

        $file->storeAs('imports', $fileId . '.csv');

        $transactionService->importFromCsv(storage_path('app/imports/' . $fileId . '.csv'));

        return back()->with('imported', true);
    }
}

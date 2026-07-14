<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly DashboardService $dashboardService) 
    {
    }

    public function index(): View
    {
        return view('admin.dashboard', [
            'dashboard' => $this->dashboardService->getStatistics(),
        ]);
    }

    public function transactions(): View
    {
        $transactions = \App\Models\Transaction::latest()
            ->paginate(10);

        return view('admin.transactions.index', compact('transactions'));
    }

    public function show($transaction): View
    {
        $transaction = \App\Models\Transaction::findOrFail($transaction);

        return view('admin.transactions.show', compact('transaction'));
    }
}
<?php

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total income, expense, balance
        $income = $user->transactions()->where('type', 'income')->sum('amount');
        $expense = $user->transactions()->where('type', 'expense')->sum('amount');
        $balance = $income - $expense;

        // Savings
        $saving = $user->savings()->first(); // Satu contoh saving

        return view('dashboard', compact('user', 'income', 'expense', 'balance', 'saving'));
    }
}

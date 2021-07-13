<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\{User, Transaction, Product};

class DashboardController extends Controller
{
    public function index()
    {
    	$totalUsers = User::count();
    	$totalProducts = Product::count();
    	$totalTransactionsPending = Transaction::where('status_transaction', 'sedang diproses')->count();
    	$totalTransactionsHistory = Transaction::where('status_transaction', 'telah di acc admin')->count();

    	return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalTransactionsPending', 'totalTransactionsHistory'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
    	$transactions = Transaction::with('user', 'product')->where('status_transaction', 'sedang diproses')->latest()->paginate(10);

    	return view('admin.transactions.index', compact('transactions'));
    }

    public function accTransaction($id)
    {
    	$transaction = Transaction::findOrFail($id)->update([
    		'status_transaction' => 'telah di acc admin'
    	]);

    	return redirect()->back()->with('succss', 'Accept Successfully.');
    }

    public function logTransaction()
    {
    	$transactions = Transaction::with('user', 'product')->where('status_transaction', 'telah di acc admin')->latest()->paginate(10);

    	return view('admin.transactions.log', compact('transactions'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{Product, Transaction};

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$products = Product::get();
        return view('frontend.home', compact('products'));
    }

    public function detail($id)
    {
    	$product = Product::findOrFail($id);

    	return view('frontend.detail', compact('product'));
    }

    public function buyItem(Request $r, $id)
    {
    	$r->validate([
    		'name' => 'required',
    		'alamat' => 'required',
    		'unit' => 'required|numeric',
    	]);
    	$product = Product::findOrFail($id);
    	$totalPrice = $r->unit * $product->price;

    	$transaction = Transaction::create([
    		'user_id' => auth()->user()->id,
    		'product_id' => $product->id,
    		'unit' => $r->unit,
    		'total_price' => $totalPrice,
    		'status_transaction' => 'sedang diproses'
    	]);

    	return redirect()->back()->with('success', 'Buy Item Successfully. Please Wait For Accept by Admin.');
    }

    public function history()
    {
        $transactions = Transaction::with('user', 'product')->where('user_id', auth()->user()->id)->paginate(5);

        return view('frontend.history', compact('transactions'));
    }
}

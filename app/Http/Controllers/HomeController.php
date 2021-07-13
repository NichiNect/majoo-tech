<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Product;

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

    public function show($id)
    {
    	$product = Product::findOrFail($id);

    	return view('frontend.detail', compact('product'));
    }
}

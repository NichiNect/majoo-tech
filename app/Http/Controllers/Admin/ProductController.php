<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Product;
use \App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $r)
    {
        $r->validate([
           'picture' => ['required', 'mimes:jpg,png,jpeg'], 
        ]);
        
        if($r->hasFile('picture')) {
            $file = $r->file('picture');
            $extension = $file->extension();
            $imgName = \Str::slug($r->product_name) . '-' . time() . '.' . $extension;
            $file->storeAs('/images/products/', $imgName, 'public');
        } else {
            $imgName = '';
        }

        $product = Product::create([
            'product_name' => $r->product_name,
            'picture' => $imgName,
            'price' => $r->price,
            'description' => $r->description,
            'status' => $r->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $r, $id)
    {
        $r->validate([
           'picture' => ['mimes:jpg,png,jpeg'], 
        ]);

        $oldProduct = Product::findOrFail($id);

        if($r->hasFile('picture')) {
            \Storage::disk('public')->delete('images/products/' . $oldProduct->picture);
            $file = $r->file('picture');
            $extension = $file->extension();
            $imgName = \Str::slug($r->product_name) . '-' . time() . '.' . $extension;
            $file->storeAs('/images/products/', $imgName, 'public');
        } else {
            $imgName = $oldProduct->picture;
        }

        $oldProduct->update([
            'product_name' => $r->product_name,
            'picture' => $imgName,
            'price' => $r->price,
            'description' => $r->description,
            'status' => $r->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        \Storage::disk('public')->delete('images/products/' . $product->picture);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product Deleted Successfully.');
    }
}

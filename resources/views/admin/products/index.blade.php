@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row my-3">
        <div class="col-md-12">
            <h1>Product</h1>
            <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary">Create New Product</a>
            <div class="my-2">
            	<x-flash-message></x-flash-message>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-12">
    		<div class="table-responsive">
    			<table class="table table-hover table-striped">
    				<thead>
	    				<tr>
	    					<th>#</th>
	    					<th>Product Name</th>
	    					<th>Picture</th>
	    					<th>Price</th>
	    					<th>Description</th>
	    					<th>Status</th>
	    					<th>Action</th>
	    				</tr>
    				</thead>
    				<tbody>
    					@forelse($products as $product)
    					<tr>
    						<td>{{ $products->count() * ($products->currentPage() - 1) + $loop->iteration }}</td>
    						<td>{{ $product->product_name }}</td>
    						<td>
    							<img src="{{ $product->getImageProduct() }}" class="img-thumbnail" alt="">
    						</td>
    						<td>Rp. {{ number_format($product->price) }}</td>
    						<td>{{ \Str::limit($product->description, 200) }}</td>
    						<td>
    							<p class="p-2 bg-success rounded text-white">{{ $product->status }}</p>
    						</td>
    						<td>
    							<div class="d-flex justify-content-beteen">
	    							<a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning mx-1">Edit</a>
	    							<a href="" class="btn btn-success mx-1">Detail</a>
	    							<form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
	    								@csrf
	    								@method('delete')
		    							<button type="submit" onclick="return confirm('Are you sure to delete this?');" class="btn btn-danger mx-1">Delete</button>
	    							</form>
    							</div>
    						</td>
    					</tr>
    					@empty
    					<tr>
    						<td colspan="7">
    							<h4 class="text-center">Data Empty</h4>
    						</td>
    					</tr>
    					@endforelse
    				</tbody>

    			</table>
    			{{ $products->links() }}
    		</div>
    	</div>
    </div>
</div>
@endsection

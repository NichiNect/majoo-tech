@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-3">
        <div class="col-md-12">
            <h1>Products</h1>
        </div>
    </div>
    <div class="row">
        @forelse($products as $product)
        <div class="col-md-3">
            <div class="card">
                <img src="{{ $product->getImageProduct() }}" class="card-img-top" alt="">
                <div class="card-body">
                    <div class="p-4 text-center">
                        <h5><sup>Rp.</sup> {{ number_format($product->price) }}</h5>
                        <p class="text-left">{{ Str::limit($product->description, 150) }}</p>
                        <a href="{{ route('home.detail', $product->id) }}" class="btn btn-outline-dark">Buy</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <h5>Data Empty</h5>
        @endforelse
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row my-3">
        <div class="col-md-12">
            <h1>Transactions</h1>
            <div class="my-2">
            	<x-flash-message></x-flash-message>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-10">
    		<div class="table-responsive">
                @forelse($transactions as $transaction)
                <div class="card shadow my-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>{{ $transaction->user->name }}</h4>
                            <small>{{ $transaction->created_at->diffForHumans() . ', ' . $transaction->created_at }}</small>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Picture</th>
                                                <th>Description</th>
                                                <th>Unit Buy</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i=1;
                                            @endphp
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $transaction->product->product_name }}</td>
                                                <td>
                                                    <img src="{{ $transaction->product->getImageProduct() }}" class="img-thumbnail" alt="" style="max-width: 6rem;">
                                                </td>
                                                <td>{{ Str::limit($transaction->product->description, 150) }}</td>
                                                <td>{{ $transaction->unit }} Unit</td>
                                                <td>Rp. {{ number_format($transaction->total_price) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center align-items-center">
                                <form action="{{ route('admin.transactions.acctransaction', $transaction->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-block btn-outline-success p-4" onclick="return confirm('Are you sure want to ACC this?');">ACC</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <h5>Empty Transaction</h5>
                @endforelse

    		</div>
			{{ $transactions->links() }}
    	</div>
    </div>
</div>
@endsection

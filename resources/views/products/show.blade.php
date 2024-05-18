@extends('products.layout')

@section('content')
    <br />
    <div class="row ps-5">
        <div class="col align-items-start">
            <a class='btn btn-primary' href='{{ route('products.index') }}'>All Products</a>
        </div>
    </div>
    <br />

    <div class="container p-5">
        <div class="mb-3">
            <h3>Name:</h3>
            {{ $product->name }}
        </div>
        <div class="mb-3">
            <h3>details:</h3>
            {{ $product->details }}
        </div>
        <div class="mb-3">
            <h3>Image:</h3>
            <img src="/images/{{ $product->image }}" width="200px" height="200px" />
        </div>
    </div>
@endsection

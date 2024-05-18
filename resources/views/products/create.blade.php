@extends('products.layout')

@section('content')
    <br />
    <div class="row ps-5">
        <div class="col align-items-start">
            <a class='btn btn-primary' href='{{ route('products.index') }}'>All Products</a>
        </div>
    </div>
    <br />

    @if ($errors->any())
        <ul>
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </div>
        </ul>
    @endif

    <div class="container p-5">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">name</label>
                <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                    placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">details</label>
                <textarea class="form-control" name="details" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="exampleFormControlInput2"
                    placeholder="image@example.com">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

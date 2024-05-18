@extends('products.layout')

@section('content')
    <br />
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Details</th>
                <th scope="col" width='300px'>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr class="table-primary">
                    <td>{{ $item->id }}</td>
                    <td><img src="/images/{{ $item->image }}" width="200px" height="200px" /></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->details }}</td>
                    <td>
                        @auth
                            <form action="{{ route('products.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a class="btn btn-primary" href='{{ route('products.edit', $item->id) }}'>Edite</a>
                        @endauth
                        <a class="btn btn-info" href='{{ route('products.show', $item->id) }}'>Show</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $products->links() !!}
@endsection

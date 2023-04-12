@extends('layouts.master')

@section('content')

<div class="d-flex justify-content-between mb-1">
    <h3>Products List</h3>
    <a class="btn btn-success btn-sm" href="{{ route('logout') }}">Logout</a>


</div>
<div class="d-flex justify-content-between mb-1">
    <a class="btn btn-success btn-sm" href="{{ route('productCreate') }}">Create New</a>


</div>
@if(session()->has('success'))
<label class="alert alert-success w-100">{{session('success')}}</label>
@elseif(session()->has('error'))
<label class="alert alert-danger w-100">{{session('error')}}</label>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->description }}</td>
            <td>
                <image src="{{ asset('/Products/'.$product->image) }}" width="80">
            </td>
            <td>
                <a href="{{ route('productEdit', ['id' => $product->id]) }}" class="btn btn-success btn-sm">Edit</a>

                <form action="{{ route('productDelete', ['id' => $product->id]) }}" method="POST" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<div class="d-flex justify-content-between">
    {{ $products->render() }}
</div>

@endsection
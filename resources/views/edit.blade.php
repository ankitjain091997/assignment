@extends('layouts.master')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <h3>Edit Product</h3>
    <a class="btn btn-success btn-sm" href="{{ route('productList') }}">List Products</a>
</div>

@if(session()->has('success'))
<label class="alert alert-success w-100">{{session('success')}}</label>
@elseif ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('productUpdate', ['id' => $product->id]) }}" method="POST" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" placeholder="product name" value="{{ $product->name }}">
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="image" class="form-control" placeholder="image" value="{{$product->image}}">
                        <img src="/Products/{{ $product->image }}" width="80px">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" placeholder="product price" value="{{ $product->price }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" rows="5" placeholder="product description" class="form-control">{{ $product->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
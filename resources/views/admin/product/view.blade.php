@extends('admin.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="m-3">
            <a href="javascript:history.back()"><i class="fa-solid fa-arrow-left"></i></a>
        </div>

        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="{{ asset('product/' . $product->image) }}" alt="Product Image" class="rounded img-fluid">
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h1 class="display-5">{{ $product->name }}</h1>
                <p class="text-muted">Category: {{ $product->category->name }}</p>
                <h3 class="text-primary">{{ $product->price }} MMK</h3>
                <p class="lead">
                    {{ $product->description }}
                </p>

                <!-- Product Features List -->
                <ul class="list-unstyled">
                    <li><strong>Feature 1:</strong> High-quality build</li>
                    <li><strong>Feature 2:</strong> User-friendly interface</li>
                    <li><strong>Feature 3:</strong> Affordable price</li>
                </ul>

                <!-- Add to Cart Button -->
                <button type="button" class="mt-4 btn btn-success btn-lg">Add to Cart</button>
            </div>
        </div>
    </div>
@endsection

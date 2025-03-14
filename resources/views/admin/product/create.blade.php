@extends('admin.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center card-title">Add New Product</h5>
                        <form action="{{ route('storeProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Image Upload -->
                            <div class="mb-3 text-center">
                                <label for="image" class="form-label">
                                    <img src="{{ asset('admin/img/images.png') }}" alt="Default Image"
                                        class="mb-3 img-fluid img-thumbnail" id="previewImage">
                                </label>
                                <input type="file" id="output" name="image"
                                    class="form-control @error('image') is-invalid @enderror" onchange="loadFile(event)">
                                @error('image')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Name -->
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="mb-3 col-md-6">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="custom-select @error('category_id') is-invalid @enderror" id="category"
                                        name="category_id">
                                        <option selected disabled>Choose Category...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Price -->
                                <div class="mb-3 col-md-6">
                                    <label for="price" class="form-label ">Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" placeholder="Enter Price" step="0.01"  value="{{ old('price') }}">
                                    @error('price')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Stock -->
                                <div class="mb-3 col-md-6">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="text" class="form-control  @error('stock') is-invalid @enderror"
                                        id="stock" name="stock" placeholder="Enter Stock"  value="{{ old('stock') }}">
                                    @error('stock')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="3" placeholder="Enter Description">{{ old('description') }}
                                </textarea>
                                @error('description')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="Add Product">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

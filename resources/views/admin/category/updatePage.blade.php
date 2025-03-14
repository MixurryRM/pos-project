@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category Update</h1>
        </div>
        <div class="row" style="margin-left: 8rem">
            <div class="col-3 card" style="height: 10rem">
                <a href="{{ route("categoryList") }}" class=" text-decoration-none w-25 mt-2"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="card-body">
                    <form action="{{ route('categoryUpdate' , $category->id) }}" method="POST">
                        @csrf
                        <input type="text" name="categoryName" value="{{ old('categoryName', $category->name) }}"
                            class="form-control  @error('categoryName')
                            is-invalid
                        @enderror">
                        @error('categoryName')
                            <small class=" invalid-feedback">{{ $message }}</small>
                        @enderror

                        <input type="submit" value="Update" class="btn btn-sm btn-outline-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

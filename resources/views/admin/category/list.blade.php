@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category List</h1>
        </div>
        <div class="row" style="margin-left: 2rem">
            <div class="col-3 card" style="height: 10rem">
                <div class="card-body">
                    <form action="{{ route('categoryCreate') }}" method="POST">
                        @csrf
                        <input type="text" name="categoryName"
                            class="form-control  @error('categoryName')
                            is-invalid
                        @enderror"
                            placeholder="Category Name ...">
                        @error('categoryName')
                            <small class=" invalid-feedback">{{ $message }}</small>
                        @enderror

                        <input type="submit" value="Create" class="btn btn-outline-primary mt-2">
                    </form>
                </div>
            </div>
            <div class="col-6 offset-1">
                <table class="table">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                <td>
                                    <a href="{{ route('updatePage',$category->id) }}" class="btn btn-sm btn-outline-secondary"><i
                                            class="fa-solid fa-pen-to-square"></i></i></a>
                                    <a href="{{ route('categoryDelete', $category->id) }}"
                                        class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <span class=" d-flex justify-content-end">{{ $categories->links() }}</span>
            </div>
        </div>
    </div>
@endsection

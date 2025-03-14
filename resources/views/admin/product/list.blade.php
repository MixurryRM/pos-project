@extends('admin.layouts.master')

@section('content')
    <div class="m-5 mt-5">

        <div class="mb-2 justify-content-between d-flex">
            <div class="">
                <button class="p-2 text-white rounded-sm btn bg-secondary"><i class="ml-2 fa-solid fa-database"></i> Product
                    Counts ({{ $products->count() }})</button>
                <a href="{{ route('productListPage') }}" class="btn btn-sm btn-primary">All Product</a>
                <a href="{{ route('productListPage', 'lowAmt') }}" class="btn btn-sm btn-danger">Low Amt Stock</a>
            </div>

            <div class="">
                <form action="{{ route('productListPage') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="searchKey" class="form-control" placeholder="Enter Search Key...">
                        <button type="submit" class="text-white btn btn-dark"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Price</th>
                    <th scope="col" style="width: 10rem">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ asset('product/' . $product->image) }}" class="shadow-sm img-thumbnail"
                                style="width: 4rem"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category_name }}</td>
                        <td style="width: 7rem">
                            <button type="button" class="btn btn-secondary position-relative">
                                {{ $product->stock }}
                                @if ($product->stock <= 5)
                                    <span
                                        class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                        low amt stock
                                    </span>
                                @endif
                            </button>
                        </td>
                        <td>{{ $product->price }} mmk</td>
                        <td>
                            <a href="{{ route('viewProduct' , $product->id) }}" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('productEditPage' , $product->id) }}" class="btn btn-sm btn-outline-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></i></a>
                            <a href="{{ route('destoryProduct' , $product->id) }}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No products found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <span class=" d-flex justify-content-end">{{ $products->links() }}</span>
    </div>
@endsection

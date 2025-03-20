@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 d-sm-flex align-items-center justify-content-between">
            <h1 class="mb-0 text-gray-800 h3">Payment Method</h1>
        </div>
        <div class="row" style="margin-left: 2rem">
            <div class="col-3 card" style="height: 20rem">
                <div class="card-body">
                    <form action="{{ route('storePayment') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="text" name="account_number"
                            class="form-control mb-3  @error('account_number')
                            is-invalid
                        @enderror"
                            placeholder="Account Number ...">
                        @error('account_number')
                            <small class=" invalid-feedback">{{ $message }}</small>
                        @enderror

                        <input type="text" name="account_name"
                            class="form-control mb-3  @error('account_name')
                            is-invalid
                        @enderror"
                            placeholder="Account Name ...">
                        @error('account_name')
                            <small class=" invalid-feedback">{{ $message }}</small>
                        @enderror

                        <input type="text" name="type"
                            class="form-control mb-1  @error('type')
                            is-invalid
                        @enderror"
                            placeholder="Type ...">
                        @error('type')
                            <small class=" invalid-feedback">{{ $message }}</small>
                        @enderror

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image"
                                class="form-control @error('image')
                            is-invalid
                        @enderror">
                        </div>
                        @error('image')
                            <small class=" invalid-feedback">{{ $message }}</small>
                        @enderror
                        <input type="submit" value="Create" class="mt-2 btn btn-outline-primary">
                    </form>
                </div>
            </div>
            <div class="col-6 offset-1">
                <table class="table">
                    <thead class="text-white bg-primary">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">image</th>
                            <th scope="col">Actions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->account_number }}</td>
                                <td>{{ $payment->account_name }}</td>
                                <td>{{ $payment->type }}</td>
                                <td>
                                    @if ($payment->image)
                                        <img src="{{ asset('images/' . $payment->image) }}" alt="Payment Image"
                                            width="30" height="30">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('destoryPayment', $payment->id) }}"
                                        class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <span class=" d-flex justify-content-end">{{ $payments->links() }}</span>
            </div>
        </div>
    </div>
@endsection

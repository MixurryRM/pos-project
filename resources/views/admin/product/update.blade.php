@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-8 offset-1">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="ms-3">
                                <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                            </div> --}}
                            <div class="ms-3">
                                <a href="{{ route('products#list') }}"> <i
                                        class="fa-solid fa-arrow-left text-decoration-none text-dark"></i></a>
                            </div>

                            <div class="card-title">
                                <h3 class="text-center title-2">Update Your Pizza</h3>
                            </div>
                            <hr>

                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data"> @csrf
                                <div class="row">

                                    <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">

                                    <div class="col-6">
                                        <div class="row m-5">
                                            <div class="col-6 offset-3 ">
                                                <img src="{{ asset('storage/' . $pizza->image) }}" alt="">
                                            </div>
                                        </div>

                                        <div class=" form-control mb-3">
                                            <input type="file" name="pizzaImage"
                                                class=" @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-8 text-center offset-2 bg-dark">
                                                <button type="submit" class=" btn text-white text-center">
                                                    <i class="fa-solid fa-circle-arrow-up mr-2"></i>Update</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName"
                                                value="{{ old('pizzaName', $pizza->name) }}" type="text"
                                                class="form-control @error('pizzaName') is-invalid @enderror"
                                                placeholder="Enter Name . . .">
                                            @error('pizzaName')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" id="" cols="30" rows="10"
                                                class=" form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Description . . ."> {{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {{-- <label for="cc-payment" class="control-label mb-1">Category</label> --}}
                                            <select name="pizzaCategory"
                                                class="@error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}"
                                                        @if ($pizza->category_id == $c->id) selected @endif>
                                                        {{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice"
                                                value="{{ old('pizzaPrice', $pizza->price) }}" type="number"
                                                class="form-control  @error('pizzaPrice') is-invalid @enderror"
                                                placeholder="Enter Price . . .">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime"
                                                value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}" type="number"
                                                class="form-control  @error('pizzaWaitingTime') is-invalid @enderror"
                                                placeholder="Enter Waiting Time . . .">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" name="pizzaViewCount" disabled
                                                value="{{ old('pizzaViewCount', $pizza->view_count) }}" type="number"
                                                class="form-control ">
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament" name="role"
                                                value="{{ $pizza->created_at->format('j-F-Y') }}" type="text"
                                                class="form-control" disabled>
                                        </div>

                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    @endsection

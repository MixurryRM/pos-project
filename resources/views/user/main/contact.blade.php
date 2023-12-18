@extends('user.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5 mt-5">

            <div class="col"><img src="{{ asset('image/undraw_fitting_piece_re_pxay.svg') }}" alt=""></div>


            <div class="col">
                <div class="col-md-5">
                    <h2 class=" text-warning">Get In Touch</h2>
                    <hr>
                </div>

                <form action="{{ route('user#contactSent') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">

                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                            <div class="form-group">
                                <i class="fa-solid fa-user me-2 mt-3"></i>
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="name" value="{{ old('name', Auth::user()->name) }}"
                                    type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter New Name" disabled>
                                @error('name')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <i class="fa-solid fa-envelope me-2 mt-2"></i>
                                <label for="cc-payment" class="control-label mb-1">Email</label>
                                <input id="cc-pament" name="email" value="{{ old('email', Auth::user()->email) }}"
                                    type="text" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter New Email" disabled>
                                @error('email')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">message</label>
                                <textarea name=" message" id="" cols="30" rows="8"
                                    class=" form-control @error('message') is-invalid @enderror" placeholder="Enter your new  message">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>

                            <div class="row mt-3">
                                <button type="submit" id="sendBtn" class="btn btn-warning col-10 offset-1">Send</button>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@extends('user.layouts.master')

@section('content')
    <div class="container-fluid" style="margin-top: 10rem">
        <div class="container vh-75 d-flex justify-content-center align-items-center" style="margin-top: 5rem">
            <div class="p-4 shadow card" style="width: 100%; max-width: 1100px;">

                <div class="row">
                    <div class="col-5">
                        <h5 class="mb-4">Payment Methods</h5>
                        @foreach ($payment as $item)
                            <div class="mb-1">
                                <div class="">
                                    <b>{{ $item->type }}</b> (Name - {{ $item->account_name }} )
                                </div>
                                Account No . {{ $item->account_number }}
                                <hr>
                            </div>
                        @endforeach
                    </div>
                    <div class="col">
                        <div class="shadow-sm card">
                            <div class="card-header">
                                <h5>Payment Info</h5>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <form action="{{ route('productOrder') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4 row">
                                            <div class="col">
                                                <input type="text" name="userName" readonly
                                                    value="{{ Auth::user()->name }}"
                                                    class="form-control @error('userName') is-invalid
                                                @enderror">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="phone"
                                                    value="{{ old('phone', Auth::user()->phone) }}"
                                                    placeholder="09xxxxxxxx"
                                                    class="form-control @error('phone') is-invalid
                                                @enderror">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="address"
                                                    value="{{ old('address', Auth::user()->address) }}"
                                                    placeholder="Address...."
                                                    class="form-control @error('address') is-invalid
                                                @enderror">
                                            </div>
                                        </div>

                                        <div class="mb-4 row">
                                            <div class="col">
                                                <select name="paymentMethod" id=""
                                                    class="form-select @error('paymentMethod') is-invalid
                                             @enderror">
                                                    <option value="">Choose payment</option>
                                                    @foreach ($payment as $item)
                                                        <option value="{{ $item->type }}"
                                                            @if (old('paymentMethod') == $item->type) selected @endif>
                                                            {{ $item->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="file" name="payslipImage" id=""
                                                    class="form-control @error('payslipImage') is-invalid
                                                @enderror">
                                            </div>
                                        </div>

                                        <div class="mb-4 row">
                                            <div class="col">
                                                <input type="hidden" name="orderCode"
                                                    value="{{ $order_code[0]['order_code'] }}">
                                                Order code : <span
                                                    class="text-secondary fw-bold">{{ $order_code[0]['order_code'] }}</span>
                                            </div>
                                            <div class="col">
                                                <input type="hidden" name="totalAmt"
                                                    value="{{ $order_code[0]['total_amt'] }}">
                                                Total amount : <span
                                                    class="text-success fw-bold">{{ $order_code[0]['total_amt'] }} $</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 offset-4">
                                                <input type="submit" class="btn btn-sm btn-outline-primary"
                                                    value="Order Now . . . !">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="mb-5 ml-5">
            <a href="javascript:history.back()"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="m-5 shadow-sm card col">
            <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-5">Name :</div>
                    <div class="col-7">{{ $order[0]->user_name }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Ph No :</div>
                    <div class="col-7">
                        {{ $order[0]->user_phone }} <small class="text-success ms-1">( Database Info )</small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Address :</div>
                    <div class="col-7">
                        {{ $order[0]->user_address }} <small class="text-success ms-1">( Database Info )</small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Order Code :</div>
                    <div class="col-7">{{ $order[0]->order_code }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Order Date:</div>
                    <div class="col-7">{{ $order[0]->created_at->format('j-F-Y') }}</div>
                </div>
                <div class="mb-2 row">
                    <div class="col-5">Total Price :</div>
                    <div class="col-7">{{ $order[0]->total_price }}<br>
                        <small class="text-danger ms-1">( Contain Deleviery Charges )</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="m-5 shadow-sm card">
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-5">Contact No :</div>
                        <div class="col-7">{{ $payslipData->phone }}</div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-5">Contact Address :</div>
                        <div class="col-7">{{ $payslipData->address }}</div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-5">Payment Method :</div>
                        <div class="col-7">{{ $payslipData->payment_method }}</div>
                    </div>
                    <div class="mb-2" style="margin-left: 8rem">
                        <img src="{{ asset('payslip/' . $payslipData->payslip_image) }}" alt="Default Image"
                            class="img-fluid img-thumbnail" style="width: 10rem; height: 200px">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-5 card">
        <div class="card-header">
            <h4>Order Details</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="productTable">
                <thead class="text-white bg-primary">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Available Stock</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                        <tr>
                            <input type="hidden" class="orderCode" value="{{ $item->order_code }}">
                            <input type="hidden" class="productId" value="{{ $item->product_id }}">
                            <input type="hidden" class="qty" value="{{ $item->order_count }}">
                            <td>
                                <img src="{{ asset('product/' . $item->product_image) }}" class="shadow-sm img-thumbnail"
                                    style="width: 4rem">
                            </td>
                            </td>
                            <td>{{ $item->product_name }}</td>
                            <td>
                                {{ $item->order_count }}
                                @if ($item->order_count > $item->product_stock)
                                    <small class="text-danger">( Out Of Stock )</small>
                                @endif
                            </td>
                            <td>{{ $item->product_stock }}</td>
                            <td>{{ $item->product_price }}</td>
                            <td>{{ $item->product_price * $item->order_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

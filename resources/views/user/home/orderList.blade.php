@extends('user.layouts.master')

@section('content')
    <!-- Cart Page Start -->
    <div class="py-5 container-fluid" style="margin-top: 7rem">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Order Code</th>
                            <th scope="col">Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">
                                    <p class="mt-2 mb-0">{{ $order['created_at']->format('j-F-Y') }}</p>
                                </th>
                                <td>
                                    <p class="mt-2 mb-0">{{ $order['order_code'] }}</p>
                                </td>
                                <td>
                                    @if ($order['status'] == '0')
                                        <p class="mt-2 mb-0 rounded shadow-sm btn btn-warning">Pending</p>
                                    @elseif ($order['status'] == '1')
                                        <p class="mt-2 mb-0 rounded shadow-sm btn btn-success">Accept</p>
                                        <span class="text-danger ms-3"><i class="fa-regular fa-clock"></i> Waiting time 3 days</span>
                                    @else
                                        <p class="mt-2 mb-0 rounded shadow-sm btn btn-danger">Reject</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

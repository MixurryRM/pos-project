@extends('user.layouts.master')

@section('content')
    <!-- Cart Page Start -->
    <div class="py-5 container-fluid" style="margin-top: 7rem">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                        @forelse ($cart as $item)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('product/' . $item->image) }}"
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                            alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mt-4 mb-0">{{ $item->name }}</p>
                                </td>
                                <td>
                                    <p class="mt-4 mb-0 price">{{ $item->price }} $</p>
                                </td>
                                <td>
                                    <div class="mt-4 input-group quantity" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="border btn btn-sm btn-minus rounded-circle bg-light">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="text-center border-0 form-control form-control-sm qty"
                                            value="{{ $item->qty }}">
                                        <div class="input-group-btn">
                                            <button class="border btn btn-sm btn-plus rounded-circle bg-light">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mt-4 mb-0 total">{{ $item->price * $item->qty }} $</p>
                                </td>
                                <td>
                                    <input type="hidden" class="cartId" value="{{ $item->cart_id }}">
                                    <input type="hidden" class="productId" value="{{ $item->product_id }}">
                                    <button class="mt-4 border btn btn-md rounded-circle bg-light remove-btn">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <input type="text" class="py-3 mb-4 border-0 rounded border-bottom me-5" placeholder="Coupon Code">
                <button class="px-4 py-3 btn border-secondary rounded-pill text-primary" type="button">Apply
                    Coupon</button>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="rounded bg-light">
                        <div class="p-4">
                            <h1 class="mb-4 display-6">Cart <span class="fw-normal">Total</span></h1>
                            <div class="mb-4 d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0 subTotal">${{ $total }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">Flat rate: $100</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4 finalTotal">${{ $total + 100 }}</p>
                        </div>
                        <button @if (count($cart) == 0) disabled @endif
                            class="px-4 py-3 mb-4 btn border-secondary rounded-pill text-primary text-uppercase ms-4"
                            id="btn-checkout" type="button">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection

@section('js-section')
    <script>
        $(document).ready(function() {

            $(".btn-minus").click(function() {
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find('.price').text().replace('$', '');
                $qty = $parentNode.find('.qty').val();
                $total = $price * $qty;
                $parentNode.find('.total').text($total + '$');
                finalCalculation();
            });

            $(".btn-plus").click(function() {
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find('.price').text().replace('$', '');
                $qty = $parentNode.find('.qty').val();
                $total = $price * $qty;
                $parentNode.find('.total').text($total + '$');
                finalCalculation();
            });

            function finalCalculation() {
                $total = 0;
                $('#productTable tbody tr').each(function(index, item) {
                    $total += Number($(item).find('.total').text().replace('$', ''))
                })
                $('.subTotal').html($total + '$')
                $('.finalTotal').html($total + 100 + '$');
            }

            //remove btn
            $('.remove-btn').click(function() {
                $parentNode = $(this).parents('tr');
                $cartId = $parentNode.find('.cartId').val();

                $data = {
                    'cartId': $cartId
                }

                $.ajax({
                    type: 'get',
                    url: '/user/cart/delete',
                    dataType: 'json',
                    data: $data,
                    success: function(res) {
                        res.status == 'success' ? location.reload() : '';
                    }
                })
            })

            //btn-checkout
            $('#btn-checkout').click(function() {
                $orderList = [];
                $userId = $('#userId').val();
                $orderCode = 'CL-POS-' + Math.floor(Math.random() * 100000000);

                $('#productTable tbody tr').each(function(index, row) {
                    $productId = $(row).find('.productId').val();
                    $qty = $(row).find('.qty').val();

                    $total = 0;
                    $('#productTable tbody tr').each(function(index, item) {
                        $total += $(item).find('.total').text().replace('$', '') * 1
                    })

                    $orderList.push({
                        'user_id': $userId,
                        'product_id': $productId,
                        'qty': $qty,
                        'order_code': $orderCode,
                        'total_amt' : $total + 100
                    })
                })

                $.ajax({
                    type: 'get',
                    url: '/user/cart/temp',
                    dataType: 'json',
                    data: Object.assign({}, $orderList),
                    success: function(res) {
                        res.status == 'success' ? location.href = '/user/payment' : ''
                    }
                })
            })
        });
    </script>
@endsection

 @extends('admin.layouts.master')

 @section('title', 'Category List Page')

 @section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
         <div class="section__content section__content--p30">
             <div class="container-fluid">
                 <div class="table-responsive table-responsive-data2">
                     <table class="table table-data2 text-center">
                         <div class="ms-3">
                             <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                         </div>

                         <div class="row col-5">
                             <div class="card mt-4">
                                 <div class="card-body">
                                     <h3> <i class="fa-solid fa-clipboard me-3"></i>ORDER INFO</h3>
                                     <small class=" text-warning mt-1"><i
                                             class="fa-solid fa-triangle-exclamation me-2"></i>Include Delivery
                                         Charges</small>
                                 </div>
                                 <div class="card-body">
                                     <div class="row mb-3">
                                         <div class="col"><i class="fa-solid fa-user me-3"></i>Name</div>
                                         <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                                     </div>

                                     <div class="row mb-3">
                                         <div class="col"><i class="fa-solid fa-barcode me-3"></i>Order Code</div>
                                         <div class="col"> {{ $orderList[0]->order_code }}</div>
                                     </div>

                                     <div class="row mb-3">
                                         <div class="col"> <i class="fa-regular fa-clock  me-3"></i>Order Date</div>
                                         <div class="col">{{ $orderList[0]->created_at->format('F-j-Y') }}
                                         </div>
                                     </div>

                                     <div class="row mb-3">
                                         <div class="col"><i class="fa-solid fa-money-bill-wave me-3"></i>Total
                                         </div>
                                         <div class="col"> {{ $order->total_price }} MMK</div>
                                     </div>

                                 </div>
                             </div>
                         </div>

                         <thead>
                             <tr>
                                 <th>Order Id</th>
                                 <th>Product Image</th>
                                 <th>Product Name</th>
                                 <th>Order Date</th>
                                 <th>Qty</th>
                                 <th>Amount</th>
                             </tr>
                         </thead>
                         <tbody id="dataList">
                             @foreach ($orderList as $o)
                                 <tr class="tr-shadow">
                                     <td>{{ $o->id }}</td>
                                     <td><img src="{{ asset('storage/' . $o->product_image) }}"
                                             class=" shadow-sm img-thumbnail" style="height: 100px">
                                     </td>
                                     <td>{{ $o->product_name }}</td>
                                     <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                     <td>{{ $o->qty }}</td>
                                     <td>{{ $o->total }}</td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
                 <!-- END DATA TABLE -->
             </div>
         </div>
     </div>
     <!-- END MAIN CONTENT-->
 @endsection

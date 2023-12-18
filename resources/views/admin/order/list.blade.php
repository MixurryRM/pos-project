 @extends('admin.layouts.master')

 @section('title', 'Category List Page')

 @section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
         <div class="section__content section__content--p30">
             <div class="container-fluid">
                 {{-- <div class="col-md-12">
                     <!-- DATA TABLE -->
                     <div class="table-data__tool">
                         <div class="table-data__tool-left">
                             <div class="overview-wrap">
                                 <h2 class="title-1">Order List</h2>
                             </div>
                         </div>
                     </div>
                 </div> --}}


                 <div class="row">

                     <form action="{{ route('admin#changeStatus') }}" method="post" class="col-5 mb-5">
                         <div class="input-group mb-3">
                             @csrf
                             <label class="mt-1 me-2">Order Status:</label>

                             <button type="text" class="btn btn-sm bg-white ml-2 input-group-text" input-group-text><i
                                     class="fa-solid  fa-database mr-2"></i>{{ $order->total() }}</button>

                             <select class="form-select ml-2" name="orderStatus">
                                 <option value="">All</option>
                                 <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                 <option value="1" @if (request('orderStatus') == '1') selected @endif>Success</option>
                                 <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                             </select>
                             <button type="submit" class="btn btn-sm bg-dark text-white ml-2 input-group-text"
                                 input-group-text><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                         </div>
                     </form>

                     @if (count($order) != 0)
                         <div class="table-responsive table-responsive-data2">
                             <table class="table table-data2 text-center">
                                 <thead>
                                     <tr>
                                         <th>User Id</th>
                                         <th>User Name</th>
                                         <th>Order Date</th>
                                         <th>Order Code</th>
                                         <th>Amount</th>
                                         <th>Status</th>
                                     </tr>
                                 </thead>
                                 <tbody id="dataList">
                                     @foreach ($order as $o)
                                         <tr class="tr-shadow">
                                             <input type="hidden" class="orderId" value="{{ $o->id }}">
                                             <td class="">{{ $o->user_id }}</td>
                                             <td class="">{{ $o->user_name }}</td>
                                             <td class="">{{ $o->created_at->format('F-j-Y') }}</td>
                                             <td class="">
                                                 <a href="{{ route('admin#listInfo', $o->order_code) }}"
                                                     class="text-primary text-decoration-none">{{ $o->order_code }}</a>
                                             </td>
                                             <td class="amount">{{ $o->total_price }}MMK</td>
                                             <td class="">
                                                 <select name="status" class="form-control text-center statusChange">
                                                     <option value="0"
                                                         @if ($o->status == 0) selected @endif>
                                                         Pending</option>
                                                     <option value="1"
                                                         @if ($o->status == 1) selected @endif>
                                                         Success</option>
                                                     <option value="2"
                                                         @if ($o->status == 2) selected @endif>
                                                         Reject
                                                     </option>
                                                 </select>
                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                             <div class="mt-3">
                                 {{-- {{ $order->links() }} --}}
                             </div>
                         </div>
                     @else
                         <h3 class=" text-secondary text-center">There Is No Order Here!</h3>
                     @endif


                     <!-- END DATA TABLE -->
                 </div>
             </div>
         </div>
     </div>
     <!-- END MAIN CONTENT-->
 @endsection

 @section('scriptScoure')
     <script>
         $(document).ready(function() {
             //  $('#orderStatus').change(function() {
             //      $status = $('#orderStatus').val();
             //      $.ajax({
             //          url: 'http://127.0.0.1:8000/order/ajax/status',
             //          data: {
             //              'status': $status,
             //          },
             //          type: 'GET',
             //          dataType: 'json',
             //          success: function(response) {
             //              $list = '';
             //              for (let $i = 0; $i < response.length; $i++) {

             //                  $months = ['January', 'Febuary', 'March', 'April', 'May', 'June',
             //                      'July', 'August', 'September', 'October', 'November',
             //                      'December'
             //                  ];
             //                  $dbDate = new Date(response[$i].created_at);
             //                  $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
             //                      $dbDate.getFullYear();

             //                  if (response[$i].status == 0) {
             //                      $message = `
        //                     <select name="status" class="form-control text-center statusChange">
        //                                  <option value="0" selected>
        //                                      Pending</option>
        //                                  <option value="1">
        //                                      Success</option>
        //                                  <option value="2">Reject
        //                                  </option>
        //                              </select>`
             //                  } else if (response[$i].status == 1) {
             //                      $message = `
        //                     <select name="status" class="form-control text-center statusChange">
        //                                  <option value="0">
        //                                      Pending</option>
        //                                  <option value="1" selected>
        //                                      Success</option>
        //                                  <option value="2">Reject
        //                                  </option>
        //                              </select>`
             //                  } else if (response[$i].status == 2) {
             //                      $message = `
        //                     <select name="status" class="form-control text-center statusChange">
        //                                  <option value="0">
        //                                      Pending</option>
        //                                  <option value="1">
        //                                      Success</option>
        //                                  <option value="2" selected>Reject
        //                                  </option>
        //                              </select>`
             //                  }

             //                  $list += `
        //                        <tr class="tr-shadow">
        //                          <input type="hidden" class="orderId" value="${response[$i].id}">
        //                          <td class="">${response[$i].user_id}</td>
        //                          <td class="">${response[$i].user_name}</td>
        //                          <td class="">${response[$i].order_code}</td>
        //                          <td class="">${$finalDate}</td>
        //                          <td class="">${response[$i].total_price}</td>
        //                          <td class=""> ${$message}</td>
        //                         </tr>`;
             //              }
             //              $('#dataList').html($list);
             //          }
             //      })
             //  });

             //change status
             $('.statusChange').change(function() {

                 $parentNode = $(this).parents('tr');
                 //  $price = Number($parentNode.find('.amount').text().replace('MMK', ''));
                 $currentStatus = $(this).val();
                 $orderId = $parentNode.find('.orderId').val();
                 $data = {
                     'orderId': $orderId,
                     'status': $currentStatus
                 };

                 $.ajax({
                     url: '/order/ajax/change/status',
                     data: $data,
                     type: 'GET',
                     dataType: 'json',
                 })
             })
         })
     </script>
 @endsection

@extends('admin.layouts.master')

@section('content')
    <div class="m-5 mt-5">

        <div class="mb-3 justify-content-between d-flex">
            <div class="">
                <button class="p-2 text-white rounded-sm btn bg-secondary"><i class="ml-2 fa-solid fa-database"></i> Order
                    Counts 20</button>
            </div>

            <div class="">
                <form action="{{ route('orderList') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="searchKey" class="form-control" placeholder="Enter Search Key...">
                        <button type="submit" class="text-white btn btn-secondary"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="text-white bg-primary">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Order Code</th>
                    <th scope="col">User Name</th>
                    <th scope="col" style="width: 10rem">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $item)
                    <tr>
                        <input type="hidden" class="orderCode" name="orderCode" value="{{ $item->order_code }}">
                        <td>{{ $item->created_at->format('j-F-Y') }}</td>
                        <td class="text-primary"><a
                                href="{{ route('orderDetails', $item->order_code) }}">{{ $item->order_code }}</a></td>
                        <td>{{ $item->user_name }}</td>
                        <td>
                            <select name="" id="" class="form-control statusChange">
                                <option value="0" @if ($item->status == 0) selected @endif>Pending</option>
                                <option value="1" @if ($item->status == 1) selected @endif>Success</option>
                                <option value="2" @if ($item->status == 2) selected @endif>Reject</option>
                            </select>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No products found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <span class=" d-flex justify-content-end">{{ $orders->links() }}</span>
    </div>
@endsection

@section('js-section')
    <script>
        $(document).ready(function() {
            $('.statusChange').change(function(){
                $changeValue = $(this).val();
                $orderCode = $(this).parents('tr').find('.orderCode').val();

                $data = {
                    'orderCode': $orderCode,
                    'changeValue': $changeValue
                }

                $.ajax({
                    url: "{{ route('orderChangeStatus') }}",
                    method: 'GET',
                    data: $data,
                    dataType: 'json',
                    success: function(res){
                       res.status == 'success' ? location.reload() : ''
                    }
                })
            } )
        });
    </script>
@endsection

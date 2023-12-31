<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct ordertlist page
    public function list(){
                 $order = Order::select('orders.*','users.name as user_name')
                 ->leftJoin('users','users.id','orders.user_id')
                 ->orderBy('created_at','desc')
                 ->paginate(5);
        return view('admin.order.list',compact('order'));
    }

    //sort ajax status
    public function changeStatus(Request $request){

        // $request->status = $request->status == null ? "" :  $request->status;
          $order = Order::select('orders.*','users.name as user_name')
                 ->leftJoin('users','users.id','orders.user_id')
                 ->orderBy('created_at','desc');

            if ($request->orderStatus == null) {
                 $order = $order->paginate(5);
            } else {
                $order = $order->where('orders.status',$request->orderStatus)->paginate(5);
            }
            // dd($request->all());

        return view('admin.order.list',compact('order'));
    }

    //ajaxChangeStatus
    public function ajaxChangeStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status' => $request->status
        ]);
        $order = Order::select('orders.*','users.name as user_name')
                 ->leftJoin('users','users.id','orders.user_id')
                 ->orderBy('created_at','desc')
                 ->get();
        return response()->json($order, 200);
    }

    //List Info
    public function listInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->where('order_code',$orderCode)->get();
        return view('admin.order.productList',compact('orderList','order'));
    }
}

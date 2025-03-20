<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //diretc order list
    public function orderList()
    {
        $orders = Order::select('orders.order_code', 'orders.status', 'orders.created_at', 'users.name as user_name')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->groupBy('orders.order_code', 'orders.status', 'orders.created_at', 'users.name')
            ->when(request('searchKey'), function ($query) {
                $query->whereAny(['orders.order_code', 'users.name'], 'like', '%' . request('searchKey') . '%');
            })
            ->orderBy('orders.created_at', 'desc')
            ->paginate(8);

        return view('admin.order.list', compact('orders'));
    }

    //order details
    public function orderDetails($orderCode)
    {
        $order = Order::select('orders.count as order_count', 'orders.total_price', 'orders.order_code', 'orders.created_at', 'users.name as user_name', 'users.nickname as user_nickname', 'users.email as user_email', 'users.phone as user_phone', 'users.address as user_address', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image', 'products.stock as product_stock')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('products', 'products.id', '=', 'orders.product_id')
            ->where('order_code', $orderCode)
            ->get();

        $payslipData = PaymentHistory::where('order_code', $orderCode)->first();

        return view('admin.order.details', compact('order', 'payslipData'));
    }

    public function changeStatus(Request $request)
    {
        Order::where('order_code', $request->orderCode)->update(['status' => $request->changeValue]);

        return response()->json(['status' => 'success'],200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;

class SaleInformationController extends Controller
{
    public function saleList()
    {

        $orders = Order::leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.order_code', 'orders.status', 'orders.created_at', 'users.name as user_name')
            ->where('orders.status', '=', 1)
            ->when(request('searchKey'), function ($query) {
                $query->whereAny(['orders.order_code', 'users.name'], 'like', '%' . request('searchKey') . '%');
            })
            ->groupBy('orders.order_code', 'orders.status', 'orders.created_at', 'users.name')
            ->orderBy('orders.created_at', 'asc')
            ->paginate(8);

        return view('admin.saleInformation.list', compact('orders'));
    }

    public function saleDetail($orderCode)
    {

        $order = Order::select('orders.count as order_count', 'orders.total_price', 'orders.order_code', 'orders.created_at', 'users.name as user_name', 'users.nickname as user_nickname', 'users.email as user_email', 'users.phone as user_phone', 'users.address as user_address', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image', 'products.stock as product_stock', 'products.id as product_id')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('products', 'products.id', '=', 'orders.product_id')
            ->where('order_code', $orderCode)
            ->get();

        $payslipData = PaymentHistory::where('order_code', $orderCode)->first();

        return view('admin.saleInformation.detail', compact('order', 'payslipData'));
    }
}

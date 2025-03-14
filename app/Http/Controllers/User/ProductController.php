<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function productDetail($id, $categotyId)
    {

        $product = Product::with('category')->find($id);

        $relatedProduct = Product::with('category')->where('category_id', $categotyId)->get();

        return view('user.home.detail', compact('product', 'relatedProduct'));
    }

    public function addToCart(Request $request)
    {
        Cart::create([
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->count,
        ]);

        return to_route('userHome');
    }

    public function cartList()
    {
        $userId = Auth::user()->id;
        $cart = Cart::select('products.id as product_id', 'carts.id as cart_id', 'products.image', 'products.name', 'products.price', 'carts.qty')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('carts.user_id', $userId)
            ->get();

        $total = '0';

        foreach ($cart as $item) {
            $total += $item->price * $item->qty;
        }

        return view('user.home.cartList', compact('cart', 'total'));
    }

    public function cartDelete(Request $request)
    {
        // logger($request->cartId);
        $cartId = $request->cartId;
        Cart::where('id', $cartId)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully cart deleted!'
        ], 200);
    }

    public function productList()
    {
        $product = Product::get();
        return response()->json([
            'status' => 'success',
            'product' => $product,
        ], 200);
    }

    public function cartTemp(Request $request)
    {
        $orders = [];

        foreach ($request->all() as $item) {
            $orders[] = [
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'count' => $item['qty'],
                'order_code' => $item['order_code'],
                'total_amt' => $item['total_amt'],
                'status' => 0, // Default status
            ];
        }

        Session::put('tempCart', $orders);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function payment()
    {
        // dd(Session::get('tempCart'));
        $payment = Payment::orderBy('type', 'desc')->get();

        $order_code = Session::get('tempCart');

        return view('user.home.payment', compact('payment', 'order_code'));
    }

    public function order(Request $request)
    {

        //payslip
        $request->validate([
            'userName' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'paymentMethod' => 'required',
            'payslipImage' => 'required',
        ]);

        $paymentHistory = [
            'user_name' => $request->userName,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->paymentMethod,
            'order_code' => $request->orderCode,
            'total_amt' => $request->totalAmt,
        ];

        if ($request->hasFile('payslipImage')) {
            $fileName = uniqid() . $request->file('payslipImage')->getClientOriginalName();
            $request->file('payslipImage')->move(public_path('payslip'), $fileName);
            $paymentHistory['payslip_image'] = $fileName;
        }

        PaymentHistory::create($paymentHistory);

        //order and clear cart
        $orders = Session::get('tempCart');

        foreach ($orders as $order) {
            Order::create([
                'user_id' => $order['user_id'],
                'product_id' => $order['product_id'],
                'count' => $order['count'],
                'order_code' => $order['order_code'],
                'total_price' => $order['total_amt'],
                'status' => $order['status'],
            ]);

            Cart::where('user_id', $order['user_id'])->delete();

            return to_route('productOrderList');
        }
    }

    public function orderList()
    {
        $orders = Order::select('order_code', 'user_id', 'total_price', 'status', 'created_at')
            ->where('user_id', Auth::user()->id)
            ->groupBy('order_code', 'user_id', 'total_price', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.home.orderList', compact('orders'));
    }
}

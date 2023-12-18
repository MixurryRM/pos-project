<?php

namespace App\Http\Controllers\User;

use id;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        // logger($request->status);
        if ($request->status == 'asc') {
             $data = Product::orderBy('created_at','asc')->get();
        } else {
             $data = Product::orderBy('created_at','desc')->get();
        }
        return $data;
    }

    //add to cart
    public function addToCart(Request $request){
        // logger($request->all());
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'status' => 'success',
            'message' => 'Add To Cart Complete',
        ];

        return response()->json($response, 200);
    }

    //order
    public function order(REQUEST $request){

        $total = 0;
        foreach ($request->all() as $item) {

          $data = OrderList::create([
            'user_id' => $item['user_id'],
            'product_id' => $item['product_id'],
            'total' => $item['total'],
            'qty' =>$item['qty'],
            'order_code' => $item['order_code']
           ]);

           $total += $data->total;
        }
        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000,
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order complete',
        ],200);
    }


    //get order data
    private function getOrderData($request){
       return[
        'user_id' => $request->userId,
        'product_id' =>$request->pizzaId,
        'qty' => $request->count,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ];
    }

     //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //current product clear
    public function clearCurrentProduct(Request $request){

        Cart::where('user_id',Auth::user()->id)
                 ->where('id',$request->orderId)
                 ->where('product_id',$request->productId)
                 ->delete();
    }

    // Increase View Count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->productId)->first();

        $viewCount = [
            'view_count' => $pizza->view_count + 1,
        ];

        Product::where('id',$request->productId)->update($viewCount);
    }

    //contact list
    public function contactList(REQUEST $request){
       $data = $this->getContactData($request);
        Contact::create($data);
        $response = [
            'status' => 'success',
            'message' => 'Add To Contact Complete',
        ];

        return response()->json($response, 200);
    }

     //get contact data
    private function getContactData($request){
       return[
        'name' => $request->name,
        'email' =>$request->email,
        'message' => $request->message,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ];
    }
}



<?php

namespace App\Http\Controllers\User;

use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    //user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->paginate(6);
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart'));
    }

    //user change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //change password
    public function changePassword(Request $request){
         $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password; //hash value

        if( Hash::check($request->oldPassword, $dbHashValue)) {

            $data =  ['password' => Hash::make($request->newPassword)];
            User::where('id',Auth::user()->id)->update($data);

            // Auth::logout();
            // return redirect()->route('auth#loginPage')->with(['changeSuccess' => 'Password Changed Success...']);

            return back()->with(['changeSuccess' => 'Password Change Success...']);
        }

        return back()->with(['notMatch' => 'The old password not match.Try again!']);
    }

    //user acc change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //user acc change
    public function accountChange($id,Request $request){
        $data = $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            // 1.old image name 2.check=>dele 3.store

            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
               Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName ;

        }

        User::where('id',$id)->update($data);
        return back()-> with(['updateSuccess' => 'User Account Updated . . .']);
    }

      //user filter
      public function filter($categoryId){
          $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->paginate(3);
          $category = Category::get();
          $cart = Cart::where('user_id',Auth::user()->id)->get();
          return view('user.main.home',compact('pizza','category','cart'));
      }

      //derict pizza detail
      public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
      }

      //cart list
      public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)->get();
        // dd($cartList->toArray());

        $totalPrice = 0;
        foreach ($cartList as $c) {
              $totalPrice += $c->pizza_price*$c->qty;
        }
        return view('user.main.cart',compact('cartList','totalPrice'));
      }

      //history
      public function history(){
        $order = Order::where('user_id',Auth::user()->id)->paginate('4');
        // dd($order->toArray());
        return view('user.main.history',compact('order'));
      }

       //contact list
      public function contact(){
        return view('user.main.contact');
      }

      //direct user list page
        public function userList(){
        $user = User::when(request('key'),function($query){
            $query -> orWhere('name','like','%'. request('key') .'%')
                   -> orWhere('email','like','%'. request('key') .'%')
                   -> orWhere('gender','like','%'. request('key') .'%')
                   -> orWhere('phone','like','%'. request('key') .'%')
                   -> orWhere('address','like','%'. request('key') .'%');
             })
             ->where('role','user')->paginate(2);
        $user -> appends(request()->all());
        return view('admin.user.list',compact('user'));
    }

       //user passwork validation check
     private function passwordValidationCheck($request){
        Validator::make($request->all(),[
          'oldPassword' => 'required|min:6|max:10',
          'newPassword' => 'required|min:6|max:10',
          'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }

    //request user data
    private function getUserData($request){
        return  [
             'name' => $request->name,
             'email' => $request->email,
             'phone' => $request->phone,
             'gender'=> $request->gender,
             'address' => $request->address,
             'updated_at' => Carbon::now(),
        ];
    }


    //Acc Validation Check
    private function accountValidationCheck($request){
        Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'gender'=> 'required',
                'image' => 'mimes:jpeg,png,jpg,webp,file',
                'address' => 'required'
            ]
            )->validate();
    }


}

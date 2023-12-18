<?php

namespace App\Http\Controllers\API;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

class RouteController extends Controller
{
    //get all products list
    public function productList(){
        $product = Product::get();
        return response()->json($product, 200,);
    }

     //get all category list
     public function categoryList(){
        $category = Category::get();
        return response()->json($category, 200,);
    }

     //get all category list
     public function userList(){
        $user =  User::get();
        return response()->json($user, 200,);
    }

    // get all pos data
    public function posDataList(){
            $product = Product::get();
             $category = Category::get();
               $user =  User::get();

        $data = [
            'product' => $product,
            'category' => $category,
            'user' => $user
        ];
        return response()->json($data, 200);
    }

    //create category
    public function createCategory(Request $request){

        // dd($request->header('headerData'));
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200,);
    }

    //create contact
    public function createContact(Request $request){
       $data = [
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
       ];

       $response = Contact::create($data);
       return response()->json($response, 200);
    }

    //delete category
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            $data = Category::where('id',$request->category_id)->delete();
            return response()->json(['status' => true, 'message'=>'Success Deleting ...','Deleting Data' =>$data],200);
        }
        return response()->json(['status'=>false,'message'=>'There is no category ...'],500);
    }

    //detail category
    public function detailCategory($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            Category::where('id',$id)->get();
            return response()->json($data, 200);
        }
        return response()->json($data,500);
    }

    //update category
    public function updateCategory(Request $request){


        $categoryId = $request->category_id;

        $dbSource = Category::where('id',$categoryId)->first();
        if (isset($dbSource)) {
               $data = $this->getCategoryData($request);
               $response = Category::where('id',$categoryId)->update($data);
               return response()->json(['status'=>true ,'message' => 'Updating Success!','UpdatingData'=>$dbSource], 200);
        }
          return response()->json(['status' => false,'message'=>'Fail updating ...'], 500);
    }

    //get category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ];
    }
}

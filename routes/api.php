<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('apiTesting',function(){
    $data = [
        'message' => 'This api testing message'
    ];
    return response()->json($data, 200);
});

Route::get('product/list',[RouteController::class,'productList']);

Route::get('category/list',[RouteController::class,'categoryList']);

Route::get('user/list',[RouteController::class,'userList']);

Route::get('pos/data/list',[RouteController::class,'posDataList']);

 //create category
 Route::post('create/category',[RouteController::class,'createCategory']);

 //create contact
Route::post('create/contact',[RouteController::class,'createContact']);

//delete category
Route::post('delete/category',[RouteController::class,'deleteCategory']);


//category details
Route::get('detail/category/{id}',[RouteController::class,'detailCategory']);

//category update
Route::post('update/category',[RouteController::class,'updateCategory']);

/**
 * product list
 * 127.0.0.1:8000/api/product/list
 *
 * category list
 * 127.0.0.1:8000/api/category/list
 *
 * user list
 * 127.0.0.1:8000/api/user/list (get)
 *
 * delete category
 * 127.0.0.1:8000/api/delete/category/{id} (get)
 *
 * create category
 * 127.0.0.1:8000/api/create/category (post)
 *
 * update category
 * 127.0.0.1:8000/api/update/category (post)
 *
 * key => category_name , category_id
 */

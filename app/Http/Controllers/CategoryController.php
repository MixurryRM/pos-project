<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct Category list page
    public function list(){
        $categories = Category::when( request('key'),function($query){
                     $query->where('name','like','%'. request('key') .'%');
                     })
                     ->orderBy('id','desc')
                     ->paginate(4);
        $categories -> appends(request()->all());
        // dd($categories);
        return view ('admin.category.list',compact('categories'));
    }

    //Direct Category Create Page
    public function createPage(){
        return view('admin.category.create');
    }

    //Direct Category Create
    public function create(Request $request){
        $data = $this->categoryValidationCheck($request);
        $data = $this-> requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    //Category Delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Category Deleted...']);
    }

    //Category Edit
     public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //Category Update
    public function update($id,request $request){
      $data = $this->categoryValidationCheck($request);
      $data = $this-> requestCategoryData($request);
      Category::where('id',$id)->update($data);
      return redirect()->route('category#list')->with(['updateSuccess' => 'Category Updated...']);
    }

    //Category Validation Check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),
        ['categoryName'=> 'required|min:3|unique:categories,name,'.$request->id],
        ['categoryName.required' => 'Category Name ဖြည့်ရန်လိုအပ်နေပါသည်!',
        'categoryName.unique' => 'Category Name တူနေပါသည်။ ထပ်မံကြိုးစားပါ။',
        'categoryName.min' => 'အနည်းဆုံး ၃လုံးအထက် ရှိရပါမည်။',])->validate();
    }
    //request category data
    private function requestCategoryData($request){
        return[
            'name' => $request->categoryName
        ];
    }

}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{

    //category list page
    public function list()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.category.list', compact('categories'));
    }

    //create
    public function create(Request $request)
    {
        $this->checkValidation($request);

        Category::create([
            'name' => $request->categoryName,
        ]);

        Alert::success('Category Create', 'Category Created Successfully!');

        return back();
    }

    //delete
    public function delete($id)
    {

        Category::find($id)->delete();

        Alert::success('Category Delete', 'Category Deleted Successfully!');

        return back();
    }

    //direct update page
    public function updatePage($id)
    {
        $category = Category::find($id);

        return view('admin.category.updatePage', compact('category'));
    }

    //update
    public function update(Request $request, $id)
    {

        $this->checkValidation($request);

        Category::where('id', $id)->update([
            'name' => $request->categoryName,
            'updated_at' => Carbon::now()
        ]);

        Alert::success('Category Update', 'Category Updated Successfully!');

        return to_route('categoryList');
    }

    //check category validation
    private function checkValidation($request)
    {
        $request->validate([
            'categoryName' => 'required'
        ], [
            'categoryName.required' => 'အမျိုးအစားအမည် လိုအပ်ပါသည်။'
        ]);
    }
}

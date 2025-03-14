<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //create product
    public function create()
    {
        $categories = Category::get();
        return view('admin.product.create', compact('categories'));
    }

    //product list page
    public function productListPage($amt = 'default')
    {
        $products = Product::when(request('searchKey'), function ($query) {
            $query->where(function ($q) {
                $searchKey = '%' . request('searchKey') . '%';
                $q->whereAny(['products.name', 'categories.name'], 'like', $searchKey);
            });
        });

        if ($amt != 'default') {
            $products = $products->where('stock', '<=', 5);
        }

        $products = $products->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('created_at', 'desc')->paginate(8);
        return view('admin.product.list', compact('products'));
    }

    //product edit page
    public function editPage($id)
    {
        $categories = Category::all();
        $products = Product::where('id', $id)->find($id);
        return view('admin.product.editPage', compact('products', 'categories'));
    }

    //view each product
    public function view($id)
    {
        $product = Product::with('category')->find($id);
        return view('admin.product.view', compact('product'));
    }

    //product update
    public function update(Request $request)
    {
        $fields = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name' => 'required|unique:products,name,' . $request->product_id,
            'category_id' => 'required',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|max:999',
            'description' => 'required|max:2000',
        ]);

        if ($request->hasFile('image')) {

            if (!empty($request->oldImage) && file_exists(public_path('product/' . $request->oldImage))) {
                unlink(public_path('product/' . $request->oldImage));
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('product'), $fileName);

            $fields['image'] = $fileName;
        } else {
            $fields['image'] = $request->oldImage;
        }

        Product::where('id', $request->product_id)->update($fields);
        Alert::success('Product Updated', 'Product Updated Successfully!');
        return to_route('productListPage');
    }

    public function destory($id)
    {
        Product::destroy($id);
        Alert::success('Product Deleted', 'Product Deleted Successfully!');
        return back();
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name' => 'required|unique:products,name',
            'category_id' => 'required',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|max:999',
            'description' => 'required|max:2000',
        ]);

        if ($request->hasFile('image')) {
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('product'), $fileName);
            $fields['image'] = $fileName;
        }

        Product::create($fields);

        Alert::success('Product Create', 'Product Created Successfully!');

        return back();
    }
}

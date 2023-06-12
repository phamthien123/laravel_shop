<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function adminHome()
    {
        return view('admin.home');
    }

    public function view_category()
    {

        $data = Category::all();
        return view('admin.layout.category', compact('data'));
    }

    public function add_category(Request $request)
    {

        $data = new Category();
        $data->category_name = $request->category;

        $data->save();

        return redirect()->back()->with('message', 'Category add Successfully');
    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category Delete Successfully');
    }


    public function view_product()
    {
        $category = Category::all();
        return view('admin.layout.product', compact('category'));
    }

    public function add_product(Request $request)
    {

        $product  = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount;
        $product->category_product = $request->category;
        $image = $request->image;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imageName);
        $product->image = $imageName;
        $product->save();
        return redirect()->back()->with('message', 'Add Product Successfully');
    }

    public function show_product()
    {
        $product = Product::all();
        return view('admin.layout.show_product', compact('product'));
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.layout.edit_product', compact('product', 'category'));
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount;
        $product->category_product = $request->category;
        $image = $request->image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imageName);
            $product->image = $imageName;
        }
        $product->save();
        return redirect()->back()->with('message', 'Product Update Successfully');
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Category Delete Successfully');
    }
}

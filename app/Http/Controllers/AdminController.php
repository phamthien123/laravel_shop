<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function adminHome()
    {
        return view('admin.home');
    }

    public function view_user()
    {
        $user = User::all();
        return view('admin.layout.user', compact('user'));
    }

    public function delete_user($id)
    {
        $product = User::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'User Delete Successfully');
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
        $product->category_id = $request->category;
        $product->feature = $request->feature;
        $product->product_hot = $request->product_Hot;
        $image = $request->image;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imageName);
        $product->image = $imageName;
        $product->save();
        return redirect()->back()->with('message', 'Add Product Successfully');
    }

    public function show_product()
    {
        $product = Product::select(
            'products.id AS pid',
            'products.title',
            'products.description',
            'products.price',
            'products.discount_price',
            'products.quantity',
            'products.image',
            'products.feature',
            'products.product_hot',
            'categories.category_name'
        )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')->orderBy('pid', 'desc')->paginate(4);

        return view('admin.layout.show_product', compact('product'));
    }

    public function edit_product($id)
    {
        $product        = Product::find($id);
        $category       = Category::all();

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
        $product->category_id = $request->category;
        $product->feature = $request->feature;
        $product->product_hot = $request->product_Hot;
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

    public function show_order()
    {
        $order = Order::OrderBy('id','desc')->paginate(5);
        return view('admin.layout.order', compact('order'));
    }

    public function delivery($id)
    {
        $order = Order::find($id);
        $order->delivery_status = "Delivery";
        $order->save();
        return redirect()->back();
    }

    public function received($id)
    {
        $order = Order::find($id);
        $order->received_status = "Received";
        $order->delivery_status = "Received";
        $order->save();
        return redirect()->back();
    }

    public function searchOrder(Request $request)  {
        $searchOrder = $request->searchOrder;
        $order = Order::where('name','LIKE',"%$searchOrder%")->get();
        return view('admin.layout.order', compact('order'));
    }
}

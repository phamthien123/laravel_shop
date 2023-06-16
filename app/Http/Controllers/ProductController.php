<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class ProductController extends Controller
{
    public function homeProduct()
    {
        $productsNews   = Product::orderBy('id', 'desc')->limit(4)->get();
        $productAlls    = Product::paginate(8);
        $pro_feature    = Product::where('feature', 'Yes')->orderBy('id', 'desc')->limit(3)->get();
        $pro_hot        = Product::where('product_hot', 'Yes')->orderBy('id', 'desc')->limit(3)->get();

        return view('home.index', compact('productsNews', 'productAlls', 'pro_feature', 'pro_hot'));
    }

    public function allFeature()
    {
        $allPro_feature    = Product::where('feature', 'Yes')->orderBy('id', 'desc')->paginate(9);
        return view('home.allfeature', compact('allPro_feature'));
    }

    public function allHot()
    {
        $allPro_hot    = Product::where('product_hot', 'Yes')->orderBy('id', 'desc')->paginate(9);
        return view('home.allhot', compact('allPro_hot'));
    }

    public function product_detail($id)
    {
        $product_details = Product::select('products.id AS pid', 'products.title', 'products.price', 'products.image', 'products.discount_price', 'products.quantity', 'products.description', 'categories.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')->where('products.id', $id)->get();
        foreach ($product_details as $value => $item) {
            $cate_id = $item->category_id;
        }

        $product_related = Product::select('products.id AS pid', 'products.title', 'products.price', 'products.image')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')->where('categories.id', $cate_id)
            ->WhereNotIn('products.id', [$id])->orderBy('pid', 'desc')->limit(4)->get();

        return view('home.product_details', compact('product_details', 'product_related'));
    }
    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->Product_title = $product->title;
            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->image;
            $cart->Product_id = $product->id;
            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function showCart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.showCart', compact('cart'));
        } else {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back()->with('message', 'Delete Cart Success');
    }

    public function checkout()
    {
        $user = Auth::user();
        $userId = $user->id;

        $data = Cart::WHere('User_id', '=', $userId)->get();

        foreach ($data as $value) {
            $order = new Order();
            $order->name = $value->name;
            $order->email = $value->email;
            $order->price = $value->price;
            $order->phone = $value->phone;
            $order->address = $value->address;
            $order->User_id = $value->User_id;
            $order->product_title = $value->product_title;
            $order->image = $value->image;
            $order->Product_id = $value->Product_id;
            $order->quantity = $value->quantity;

            $order->payment_status = null;
            $order->delivery_status = 'Processing Cash';

            $order->save();

            $cart_id = $value->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'We Have Received Your Order.We Will Connect With You Soon..!');
    }

    public function stripe($Total)
    {

        return view('home.stripe', compact('Total'));
    }

    public function stripePost(Request $request,$Total)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $Total * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment"
        ]);

        $user = Auth::user();
        $userId = $user->id;

        $data = Cart::WHere('User_id', '=', $userId)->get();

        foreach ($data as $value) {
            $order = new Order();
            $order->name = $value->name;
            $order->email = $value->email;
            $order->price = $value->price;
            $order->phone = $value->phone;
            $order->address = $value->address;
            $order->User_id = $value->User_id;
            $order->product_title = $value->product_title;
            $order->image = $value->image;
            $order->Product_id = $value->Product_id;
            $order->quantity = $value->quantity;

            $order->payment_status = 'Processing Payment';
            $order->delivery_status = null;

            $order->save();

            $cart_id = $value->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }
}

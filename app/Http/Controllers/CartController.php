<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert; 



class CartController extends Controller
{
    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;
            $product = Product::find($id);
            $product_exist_id = Cart::where('Product_id', '=', $id)->where('User_id', '=', $user_id)->get('id')->first();

            if ($product_exist_id != null) {
                $cart = Cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price *$cart->quantity;
                } else {
                    $cart->price = $product->price * $cart->quantity;
                }
                Alert::success('Product Added Successfully','We have add Product to the Cart');
                $cart->Save();
                return redirect()->back();
            } else {
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
            }
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

            $order->payment_status = 'Cash To Delivery';
            $order->delivery_status = 'Processing';
            $order->received_status = '';

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

    public function stripePost(Request $request, $Total)
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

            $order->payment_status = 'Payment';
            $order->delivery_status = 'Processing';
            $order->received_status = '';

            $order->save();

            $cart_id = $value->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function orderCart()
    {
        if (Auth::id()) {

            $id = Auth::user()->id;

            $order = Order::where('user_id', '=', $id)->OrderBy('id', 'desc')->get();

            return view('home.orderCart', compact('order'));
        } else {
            return redirect('login');
        }
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->delivery_status = "Your Cancel The Order";
        $order->save();
        return redirect()->back();
    }
}

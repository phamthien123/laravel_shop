<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::check()) {
            if (Auth::user()->usertype === '0') {
                return redirect('index');
            } else {
                $total_Product = Product::all()->count();
                $total_Category = Category::all()->count();
                $total_Order = Order::all()->count();
                $total_User = User::all()->count();

                $order = Order::all();
                $order_Revenue = 0;
                foreach ($order as $itemOrder) {
                    $order_Revenue = $order_Revenue + $itemOrder->price;
                }

                $order_Processing = Order::where('delivery_status', '=', 'Processing')->get()->count();
                $order_Delivery = Order::where('delivery_status', '=', 'Delivery')->get()->count();
                $order_Received = Order::where('delivery_status', '=', 'Received')->get()->count();
                $order_Cancel = Order::where('delivery_status', '=', 'Your Cancel The Order')->get()->count();
                
                return view('admin.home', compact(
                    'total_Product',
                    'total_Category',
                    'total_Order',
                    'total_User',
                    'order_Revenue',
                    'order_Processing',
                    'order_Delivery',
                    'order_Received',
                    'order_Cancel'
                ));
            }
        }
        return redirect()->to('http://127.0.0.1:8000/index');
    }
}

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
}

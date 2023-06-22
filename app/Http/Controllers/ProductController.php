<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;


class ProductController extends Controller
{
    public function homeProduct(Request $request)
    {
        $productsNews   = Product::orderBy('id', 'desc')->limit(6)->get();
        $pro_feature    = Product::where('feature', 'Yes')->orderBy('id', 'desc')->limit(3)->get();
        $pro_hot        = Product::where('product_hot', 'Yes')->orderBy('id', 'desc')->limit(3)->get();
        $all_products   = Product::paginate(8);
        $blog = Blog::orderBy('id', 'desc')->limit(3)->get();
        return view('home.index', compact('productsNews', 'pro_feature', 'pro_hot', 'all_products', 'blog'));
    }

    public function all_Product()
    {
        $all_products    = Product::paginate(9);
        return view('home.all_Product', compact('all_products'));
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
        $product_details = Product::select(
            'products.id AS pid',
            'products.title',
            'products.price',
            'products.image',
            'products.discount_price',
            'products.quantity',
            'products.description',
            'categories.id',
            'categories.category_name',
            'products.category_id'
        )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')->where('products.id', $id)->get();

        foreach ($product_details as $value => $item) {
            $cate_id = $item->category_id;
        }

        $product_related = Product::select(
            'products.id AS pid',
            'products.title',
            'products.price',
            'products.image',
            'products.discount_price',
            'products.quantity',
            'products.description',
            'categories.id',
            'categories.category_name'
        )
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')->where('categories.id', $cate_id)
            ->WhereNotIn('products.id', [$id])->orderBy('pid', 'desc')->limit(4)->get();

        $comment    = Comment::where('product_id', $id)->get();
        $reply      = Reply::where('product_id', $id)->get();

        return view('home.product_details', compact('product_details', 'product_related', 'comment', 'reply'));
    }

    public function Search_product(Request $request)
    {
        $search = $request->search;
        $productSearch = Product::where('title', 'LIKE', "%$search%")->paginate(8);
        return view('home.Search_product', compact('productSearch'));
    }

    public function sort_by(Request $request)
    {
        if ($request->sort_by == 'lowest_price') {
            $all_products = Product::orderBy('price', 'asc')->paginate(9);
        }
        if ($request->sort_by == 'highest_price') {
            $all_products = Product::orderBy('price', 'desc')->paginate(9);
        }
        return view('home.search_result', compact('all_products'))->render();
    }
}

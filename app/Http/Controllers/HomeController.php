<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::User()->usertype;

        if ($usertype == '1') {
            return view('admin.home');
        } else {
            $productsNews   = Product::orderBy('id', 'desc')->limit(4)->get();
            $productAlls    = Product::paginate(8);
            $pro_feature    = Product::where('feature', 'Yes')->orderBy('id', 'desc')->limit(3)->get();
            $pro_hot        = Product::where('product_hot', 'Yes')->orderBy('id', 'desc')->limit(3)->get();
            return view('home.index', compact('productsNews', 'productAlls', 'pro_feature', 'pro_hot'));
        }
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
        // $product_details    = Product::find($id);
        $product_details = Product::select('products.image')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')->where('products.id', $id)->get();

        foreach ($product_details as $value => $item) {
            $cate_id = $item->category_id;
        }
        
        $product_category = Product::select('products.image')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')->where('categories.id', $cate_id)->WhereNotIn('products.id', [$id])->limit(2)->get();

        $product_related = Product::select('*')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')->where('categories.id', $cate_id)
            ->WhereNotIn('products.id', [$id])->orderBy('products.id', 'desc')->limit(4)->get();

        return view('home.product_details', compact('product_details', 'product_category','product_related'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $products = Product::with('images', 'category')->orderBy('id', 'desc')->paginate(8);
        $phones = Product::with('images', 'category')->where('category_id', 1)->orderBy('id', 'desc')->paginate(8);
        $skins = Product::with('images', 'category')->where('category_id', 2)->orderBy('id', 'desc')->paginate(8);
        $laptops = Product::with('images', 'category')->where('category_id', 3)->orderBy('id', 'desc')->paginate(8);
        $sales = Product::with('images', 'category')->orderBy('sale_price', 'desc')->paginate(8);
        $hots = Product::with('images', 'category')->where('hot', 1)->orderBy('id', 'desc')->paginate(8);
        // $categories = Category::get();
        $categories = Category::where('parent_id', 0)->get();
        $categorieall = Category::all();

        return view('frontend.index')->with([
            'products' => $products,
            'phones' => $phones,
            'skins' => $skins,
            'laptops' => $laptops,
            'sales' => $sales,
            'hots' => $hots,
            'categories' => $categories,
            'categorieall' => $categorieall
        ]);
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        $count = Product::count();
        $categories = Category::where('parent_id', 0)->get();
        $categorieall = Category::all();
        return view('frontend.shop.index')->with([
            'products' => $products,
            'count' => $count,
            'categories' => $categories,
            'categorieall' => $categorieall
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function menu($id){
        $products = Product::where('category_id', $id)->orderBy('id', 'desc')->get();
        $hots = Product::where('hot', 1)->get();
        $count = Product::where('category_id', $id)->count();
        $categorieall = Category::all();
        $categories = Category::where('parent_id', 0)->get();
        $name_category = Category::where('id', $id)->get();
        return view('frontend.shop.menu')->with([
            'products' => $products,
            'hots' => $hots,
            'count' => $count,
            'categories' => $categories,
            'categorieall' => $categorieall,
            'name_category' => $name_category
        ]);
    }

    public function create()
    {
        return view('frontend.shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

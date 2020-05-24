<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        $product_iamges = Product::with('images')->find($id);
        $path = $product_iamges->images;
        $tops = Product::with('images', 'category')->where('hot', 1)->orderBy('id', 'desc')->paginate(3);
        $categories = Category::where('parent_id', 0)->get();
        $categorieall = Category::all();
        return view('frontend.products.index')->with([
            'products' => $products,
            'tops' => $tops,
            'categories' => $categories,
            'categorieall' => $categorieall
        ]);
    }

    public function show($id) {
        $products = Product::find($id);
        // $product2 = Product::with('images')->paginate(15);
        $productscate = Product::with('images')->where('category_id', $products['category_id'])->limit(10)->get();
        $category = Category::find($products->category_id);
        $product_iamges = Product::with('images')->find($id);
        $path = $product_iamges->images;
        $tops = Product::with('images', 'category')->where('hot', 1)->orderBy('id', 'desc')->paginate(3);
        $news = Product::with('images', 'category')->orderBy('id', 'desc')->paginate(8);
        $sales = Product::with('images', 'category')->orderBy('sale_price', 'desc')->paginate(8);
        $comment_forms = Comment::orderBy('id', 'desc')->where('product_id', $id)->with('children')->whereNull('parent_id')->limit(10)->get();
        $categories = Category::where('parent_id', 0)->get();
        $categorieall = Category::all();
        return view('frontend.products.index')->with([
            'productscate' => $productscate,
            'products' => $products,
            'category' => $category,
            'path' => $path,
            'tops' => $tops,
            'news' => $news,
            'sales' => $sales,
            'comment_forms' => $comment_forms,
            'categories' => $categories,
            'categorieall' => $categorieall
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($id) {
        //$product = Product::get();
        $categories = Category::get(); //
        // $categories = Cache::remember('categories', 10, function () {
        //  return Category::get();
        // }); //
        $product10 = Category::with('product')->find($id);
        $product_cate = $product10->product;
        // foreach ($images as $image) {
        //  dd($image);
        // }
        //dd($product_cate);
        return view('fontend.category.index')->with([
            'product_cate' => $product_cate,
            'categories' => $categories,
        ]);
    }

    public function storeNews(Request $request)
    {
        $request->validate(
            [
                'user_email' => 'required|email|min:10|max:255',
            ],
            [
                'required' => ':attribute Cần nhập đúng định dạng',
                'min' => ':attribute Không được nhỏ hơn :min',
                'max' => ':attribute Không được lớn hơn :max',
            ],
            [
                'user_email' => 'Email',
            ]
        );
        $comment = new Comment();
        $comment->product_id = $request->get('product_id');
        $comment->content = $request->get('content');
        $comment->user_name = $request->get('user_name');
        $comment->user_email = $request->get('user_email');
        $comment->parent_id = $request->get('parent_id');
        $comment->status = 1;

            if ($request->ajax()) {

                        $view = view('frontend.products.ajaxcmt', ['comment' => $comment])->render();
                        $data = [
                            'code' => 200,
                            'data' => $view
                        ];
            $comment->save();
            return response()->json($data);
                    }else{
                        return back();
                    }
    }
}

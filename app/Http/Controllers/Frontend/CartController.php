<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
// use App\Model\User;
use App\Models\Product;
use App\Models\UserInfo;
use App\Models\Category;
use App\Models\Bill;
use App\Models\DetailBill;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        lay mot san pham
//        $item = Cart::add('12345', 'Product 1', 1, 1000, 0, ['size' => '990']);
//        $item = Cart::add('12346', 'Product 3', 1, 1000, 0, ['size' => '990']);
        $items = Cart::content();
                     //dd($items);
        $categories = Category::where('parent_id', 0)->get();
        $categorieall = Category::all();
////        lay nhieu san pham
//        $item = Cart::add([
//            ['id' => '12355', 'name' => 'Product 1', 'qty' => 1, 'price' => 10000, 'weight'=>0],
//            ['id' => '12455', 'name' => 'Product 2', 'qty' => 1, 'price' => 10000, 'weight'=>0]
//        ]);
//      Cart::destroy();
//        dd($item);

//        $item = Cart::content();
//                dd($item);
        return view('frontend.cart.index')->with(['items' => $items, 'categories' => $categories, 'categorieall' => $categorieall]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add2Cart($id)
    {
        $product = Product::find($id);
        Cart::add($product->id, $product->name, 1, $product->sale_price, 0);
//        $item = Cart::add('12345', 'Product 1', 1, 1000, 0, ['image' => 'aaaaa']);
        return redirect()->route('frontend.cart.index');
    }

    public function pay()
    {
        $categories = Category::where('parent_id', 0)->get();
        $categorieall = Category::all();
        $items = Cart::content();
        return view('frontend.cart.pay')->with(['items' => $items, 'categories' => $categories, 'categorieall' => $categorieall]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $items = Cart::content();
        return view('frontend.cart.pay')->with(['items' => $items]);
    }
    public function store(Request $request)
    {
        $userinfo = new Userinfo();
        $userinfo->fullname = $request->get('fullname');
        $userinfo->email = $request->get('email');
        $userinfo->phone = $request->get('phone');
        $userinfo->address = $request->get('address');
        $save = $userinfo->save();
    }

    public function createuserinfo(Request $request) {
        try {
            $userinfo = new UserInfo();
            $userinfo->fullname = $data['fullname'];
            $userinfo->email = $data['email'];
            $userinfo->phone = $data['phone'];
            $userinfo->address = $data['address'];
            $userinfo->save();

            return redirect()->route('frontend.cart.pay')->with('message success', 'Tạo mới thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function pay_bill(Request $request) {
        try {
            $items = Cart::content();
            $today = date("Y-m-d");

            $userinfo = new UserInfo();
            $userinfo->fullname = $request->name;
            $userinfo->email = $request->email;
            $userinfo->phone = $request->phone;
            $userinfo->address = $request->address;

            $userinfo->save();

            $bill = new Bill();
            $bill->quantity_buy = $request->qty_product;
            $bill->total_money = $request->totalpay_product;
            $bill->userinfo_id = $userinfo->id;
            $bill->user_id = 0;
            $bill->date = $today; 

            $bill->save();

            foreach ($items as $key => $item) {
            $billdetail = new DetailBill();
            $billdetail->bill_id = $bill->id;
            $billdetail->product_id = $item->id;
            $billdetail->quantity = $item->qty;
            $billdetail->into_money = $item->qty*$item->price;

            $billdetail->save();

            Cart::destroy($item->rowId);
            }
            return redirect()->route('frontend.cart.pay')->with('message success', 'Tạo mới thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function destroy($id){
        $carts = Cart::content()->where('id', $id);
        foreach ($carts as $cart) {
            Cart::remove($cart->rowId);
        }
        return redirect()->route('frontend.cart.index');
    }

}

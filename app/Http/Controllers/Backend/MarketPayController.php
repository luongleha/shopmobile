<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\CurlConnectionRepository;
use App\Service\PayMarket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product;
use App\Models\UserInfo;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use DB;

class MarketPayController extends Controller
{
    protected $pmk_service;
    protected $curl_connect;

    public function __construct(CurlConnectionRepository $curl_connect, PayMarket $pmk_service)
    {
        parent::__construct($curl_connect);
        $this->pmk_service = $pmk_service;
    }

    public function index(Request $request)
    {
        try {
            $result = $this->pmk_service->fbmarketList();            
            $curpage = ($result->currentPage() * $result->perPage()) - $result->perPage();
            $count = $this->pmk_service->fbmarketcountList();
            $categories = $this->pmk_service->getPostCategory();
            $userinfos = UserInfo::orderBy('id', 'desc')->get('id');
            $items = Cart::content();
            // dd($items);

            if ($request->ajax()) {
                $view = view('backend.market_pay.list_pay_product_table', [
                    'products' => $result,
                    'curpage' => $curpage,
                    'product_category' => $categories,
                    'userinfos' => $userinfos,
                    'items' => $items])->render();
                return response()->json(['code' => 200, 'data' => $view]);
            } else {
                return view('backend.market_pay.list_pay_product', [
                    'products' => $result,
                    'curpage' => $curpage,
                    'count' => $count,
                    'product_category' => $categories,
                    'userinfos' => $userinfos,
                    'items' => $items]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function create(Request $request) {
        try {
            $user = Auth::user()->id;
            $result = $this->pmk_service->createPostOrder($request->all(), $user);
            return redirect()->route('product.index')->with('message success', 'Tạo mới thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function search(Request $request)
    {
        try {
        $user = Auth::user()->id;
        $result = $this->pmk_service->fbmarketList();
        $products = Product::where('user_id', $user)
                        ->where(function($query) use($request){
                            $query->where('id','LIKE','%'.$request->value."%");
                            $query->orWhere('name','LIKE','%'.$request->value."%");
                            $query->orwhere('content','LIKE','%'.$request->value."%");
                        })
                        ->orderBy('id', 'desc')
                        ->get();
        if($request->ajax())
        {
                $view = view('backend.market_pay.search_pay_product_table', ['products' => $products])->render();
                return response()->json($view);
        }
        else {
                return view('backend.market_pay.list_pay_product',['products' => $products]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function logsearch(Request $request)
    {
        try {
        $user = Auth::user()->id;
        $result = $this->pmk_service->fbmarketList();
        $products = Product::where('user_id', $user)
                        ->where(function($query) use($request){
                            if ($request->cate) {
                                $query->where('category_id','LIKE','%'.$request->cate."%");
                            }
                            if ($request->status) {
                                $query->where('status','LIKE','%'.$request->status."%");
                            }
                            // if ($request->account) {
                            //     $query->where('account','LIKE','%'.$request->account."%");
                            // }
                            if ($request->time_start) {
                                $query->where('created_at','LIKE','%'.$request->time_start."%");
                            }
                        })
                        ->orderBy('id', 'desc')
                        ->get();
        if($request->ajax())
        {
                $view = view('backend.market_pay.search_pay_product_table', ['products' => $products])->render();
                return response()->json($view);
        }
        else {
                return view('backend.market_pay.list_pay_product',['products' => $result]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function pay(Request $request) {
        try {
            $user = Auth::user()->id;
            $items = Cart::content();
            $result = $this->pmk_service->createBillOrder($request->all(), $user, $items);
            return redirect()->route('market-pay.index')->with('message success', 'Thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function add2Cart(Request $request)
    {
        $product = Product::find($request->id);
        // dd($product);
        Cart::add($product->id, $product->name, 1, $product->sale_price, 0);
//        $item = Cart::add('12345', 'Product 1', 1, 1000, 0, ['image' => 'aaaaa']);
        return redirect()->route('market-pay.index');
    }

    public function destroy($id){
        // $carts = Cart::content()->where('id', $id);
        // foreach ($carts as $cart) {
        //     Cart::remove($cart->rowId);
        // }
        Cart::destroy($id);
        return redirect()->route('market-pay.index');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\CurlConnectionRepository;
use App\Service\ProductMarket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use DB;

class ProductMarketController extends Controller
{
//    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $fbmk_service;
    protected $curl_connect;

    public function __construct(CurlConnectionRepository $curl_connect, ProductMarket $fbmk_service)
    {
        parent::__construct($curl_connect);
        $this->fbmk_service = $fbmk_service;
    }

    public function index(Request $request)
    {
        try {
            $result = $this->fbmk_service->fbmarketList();
            $curpage = ($result->currentPage() * $result->perPage()) - $result->perPage();
            $count = $this->fbmk_service->fbmarketcountList();
            $categories = $this->fbmk_service->getPostCategory();

            if ($request->ajax()) {
                $view = view('backend.fb_market.list_post_product_table', [
                    'products' => $result,
                    'curpage' => $curpage,
                    'product_category' => $categories])->render();
                return response()->json(['code' => 200, 'data' => $view]);
            } else {
                return view('backend.fb_market.list_post_product', [
                    'products' => $result,
                    'curpage' => $curpage,
                    'count' => $count,
                    'product_category' => $categories]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function create(Request $request) {
        try {
            $user = Auth::user()->id;
            $result = $this->fbmk_service->createPostOrder($request->all(), $user);
            return redirect()->route('product.index')->with('message success', 'Tạo mới thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function update(Request $request) {
        try {
            $option = 1;
            $user = Auth::user()->id;
            $request->validate([
                'id' => 'required',
            ]);
            $result = $this->fbmk_service->editPostOrder($request->all(), $user);
            return redirect()->route('product.index')->with('message success', 'Tạo mới thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function detail(Request $request) {
        try {
            $option = 1;

            $product = Product::with('images')->find($request->id);
            $path = $product->images;

            $arrimg = array();
            foreach ($path as $item) {
                $arrimg = array_merge($arrimg, explode(',', $item['path']) );
            }
            return response()->json(['fbm' => $product, 'arrimg' => $arrimg]);
        } catch (\Exception $e) {
            $res = [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
            return response()->json($res);
        }
    }

    public function delete(Request $request) {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $this->fbmk_service->deletePost($request->id);
            return response()->json(['code' => 200, 'message' => 'Delete success']);
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function deleteMultiple(Request $request) {
        try {
            $ids = $request->ids;
            Product::whereIn('id',explode(",",$ids))->delete();
            return response()->json(['success'=>"Product Deleted successfully."]);
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        try {
        $user = Auth::user()->id;
        $result = $this->fbmk_service->fbmarketList();
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
                $view = view('backend.fb_market.search_post_product_table', ['products' => $products])->render();
                return response()->json($view);
        }
        else {
                return view('backend.fb_market.list_post_product',['products' => $products]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function logsearch(Request $request)
    {
        try {
        $user = Auth::user()->id;
        $result = $this->fbmk_service->fbmarketList();
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
                $view = view('backend.fb_market.search_post_product_table', ['products' => $products])->render();
                return response()->json($view);
        }
        else {
                return view('backend.fb_market.list_post_product',['products' => $result]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }
}
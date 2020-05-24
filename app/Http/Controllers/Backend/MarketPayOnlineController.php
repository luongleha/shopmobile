<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\CurlConnectionRepository;
use App\Service\PayOnlineMarket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\UserInfo;
use App\Models\Bill;
use App\Models\DetailBill;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use DB;

class MarketPayOnlineController extends Controller
{
    protected $pomk_service;
    protected $curl_connect;

    public function __construct(CurlConnectionRepository $curl_connect, PayOnlineMarket $pomk_service)
    {
        parent::__construct($curl_connect);
        $this->pomk_service = $pomk_service;
    }

    public function index(Request $request)
    {
        try {
            $result = $this->pomk_service->payonlineList();            
            $curpage = ($result->currentPage() * $result->perPage()) - $result->perPage();
            $count = $this->pomk_service->payonlinecountList();

            if ($request->ajax()) {
                $view = view('backend.market_pay_online.list_pay_online_product_table', [
                    'bills' => $result,
                    'curpage' => $curpage])->render();
                return response()->json(['code' => 200, 'data' => $view]);
            } else {
                return view('backend.market_pay_online.list_pay_online_product', [
                    'bills' => $result,
                    'curpage' => $curpage,
                    'count' => $count]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function confirm(Request $request) {
        try {
        	$user = Auth::user()->id;
            $request->validate([
                'id' => 'required',
            ]);
            $this->pomk_service->payonlineconfirm($request->id, $user);
            return response()->json(['code' => 200, 'message' => 'Confirm success']);
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function detail(Request $request) {
        try {
            $option = 1;

            $bill = Bill::find($request->id);

            $userinfo = UserInfo::find($bill->userinfo_id);
            $details = DetailBill::where('bill_id', $request->id)->get();
            return response()->json(['bill' => $bill, 'user' => $userinfo, 'details' => $details]);
        } catch (\Exception $e) {
            $res = [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
            return response()->json($res);
        }
    }

    public function search(Request $request)
    {
        try {
        $result = $this->pomk_service->payonlineList();           
        $bills = Bill::where(function($query) use($request){
                            $query->where('id','LIKE','%'.$request->value."%");
                        })
                        ->orderBy('id', 'desc')
                        ->get();
        if($request->ajax())
        {
                $view = view('backend.market_pay_online.search_pay_online_product_table', ['bills' => $bills])->render();
                return response()->json($view);
        }
        else {
                return view('backend.market_pay_online.list_pay_online_product',['bills' => $result]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function logsearch(Request $request)
    {
        try {
        $result = $this->pomk_service->payonlineList();           
        $bills = Bill::where(function($query) use($request){
                            if ($request->time_start) {
                                $query->where('created_at','LIKE','%'.$request->time_start."%");
                            }
                        })
                        ->orderBy('id', 'desc')
                        ->get();
        if($request->ajax())
        {
                $view = view('backend.market_pay_online.search_pay_online_product_table', ['bills' => $bills])->render();
                return response()->json($view);
        }
        else {
                return view('backend.market_pay_online.list_pay_online_product',['bills' => $result]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }
}

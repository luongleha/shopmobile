<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\CurlConnectionRepository;
use App\Service\DailySales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Bill;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use DB;

class MarketDailySalesController extends Controller
{
    protected $dsmk_service;
    protected $curl_connect;

    public function __construct(CurlConnectionRepository $curl_connect, DailySales $dsmk_service)
    {
        parent::__construct($curl_connect);
        $this->dsmk_service = $dsmk_service;
    }

    public function index(Request $request)
    {
        try {
            $today = date("Y-m-d");
            $result = $this->dsmk_service->dailysalelList($today);
            $sum_bill = Bill::where('date', $today)->get()->count();
            $sum_quantity = Bill::where('date', $today)->sum('quantity_buy');
            $sum_money = Bill::where('date', $today)->sum('total_money');
            // $curpage = ($result->currentPage() * $result->perPage()) - $result->perPage();
            $count = $this->dsmk_service->dailysalecountList($today);

            if ($request->ajax()) {
                $view = view('backend.daily_sales.list_daily_sale_table', [
                    'bills' => $result,
                    'sum_bill' => $sum_bill,
                    'sum_quantity' => $sum_quantity,
                    'sum_money' => $sum_money,
                    // 'curpage' => $curpage
                ])->render();
                return response()->json(['code' => 200, 'data' => $view]);
            } else {
                return view('backend.daily_sales.list_daily_sale', [
                    'bills' => $result,
                    'sum_bill' => $sum_bill,
                    'sum_quantity' => $sum_quantity,
                    'sum_money' => $sum_money,
                    // 'curpage' => $curpage,
                    'count' => $count]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function create(Request $request) {
        try {
            $today = date("Y-m-d");
            $count = $this->dsmk_service->dailysalecountList($today);
            $user = Auth::user()->id;
            $result = $this->dsmk_service->createDailySale($request->all(), $user, $today, $count);
            return redirect()->route('market-daily-sales.index')->with('message success', 'Chốt thành công');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function show(Request $request)
    {
        try {
            $result = $this->dsmk_service->showdailysalelList();
            $count = $this->dsmk_service->showdailysalecountList();

            if ($request->ajax()) {
                $view = view('backend.detail_daily_sale.list_detail_daily_sale_table', [
                    'dailysales' => $result])->render();
                return response()->json(['code' => 200, 'data' => $view]);
            } else {
                return view('backend.detail_daily_sale.list_detail_daily_sale', [
                    'dailysales' => $result,
                    'count' => $count]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\CurlConnectionRepository;
use App\Service\FacebookMarket;
use App\Service\FacebookAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\Bill;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\DailySale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $count_product = Product::all()->count();
        $count_bill = Bill::all()->count();
        $revenue = number_format(DailySale::sum('total_money'));
        $count_user = User::all()->count();
        $count_category = Category::all()->count();
        $count_user_info = UserInfo::all()->count();
        return view('backend.home.index')->with([
                'count_product' => $count_product,
                'count_bill' => $count_bill,
                'revenue' => $revenue,
                'count_user' => $count_user,
                'count_category' => $count_category,
                'count_user_info' => $count_user_info
            ]);
    }

        public function getcache(){
            $categories = Cache::remember('categories', 60*60, function() {
                return $categories = Category::get();
            });

//            top san pham
            $top_products = Cache::remember('top_products', 60, function() {
                return $roducts = Prodcuct::take(5)->get();
            });
            // dd($categories);
        }
}

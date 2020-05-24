<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index(){
       if (Gate::allows('view-dashboard')){
       	$user = User::get()->count();
       	$users = User::orderBy('id', 'desc')->limit(4)->get();
       	$product = Product::get()->count();
       	$products = Product::orderBy('id', 'desc')->limit(4)->get();
           return view('backend.dashboard')->with([
           		'user' => $user,
           		'users' => $users,
           		'product' => $product,
           		'products' => $products
           ]);
        }else{
           return abort(404);
       }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieController extends Controller
{
    public function set(){
        Cookie::queue('user_id', 1);
        Cookie::queue('email', 'haspro98@gmail.com');
        return response('hello')->cookie('giohang', '1', 10);
    }

    public function get(){
        $value = Cookie::get('giohang');
        $user_id = Cookie::get('user_id');
        $email = Cookie::get('email');
        $laravel = Cookie::get('laravel_session');
        echo $laravel . "\n";
        echo $value . "\n";
        echo $user_id . "\n";
        echo $email . "\n";
    }
}

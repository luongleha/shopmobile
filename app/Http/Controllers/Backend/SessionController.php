<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function set(){
        session([
            'user_id' => '123',
            'name' => 'ha'
        ]);
        session()->put('age', 16);
    }

    public function get(){
        $value = session()->get('user_id');
        $name = session()->get('name');
        $age = session()->get('age');

        $phone = session()->get('phone', '123456');

        if (session()->has('phone')){
            echo 'co';
        }else{
            echo 'khong';
        }

//        ------has va exists deu nhu nhau------

//        if (session()->exists('phone')){
//            echo 'co';
//        }else{
//            echo 'khong';
//        }

        dd(session()->all());
        echo 'Name: ', $name;

        echo 'user_id: ', $value;

        echo 'age: ', $age;

        echo 'phone: ', $phone;
        dd($value);
    }

    public function get2(){
        session()->pull('name', 'default');
        $name = session()->get('name');

        echo 'name: ', $name;
    }
}

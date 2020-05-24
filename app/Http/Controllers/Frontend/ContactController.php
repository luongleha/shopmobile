<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class ContactController extends Controller
{
    public function index(){
    	$categorieall = Category::all();
    	$categories = Category::where('parent_id', 0)->get();
        return view('frontend.contact')->with(['categories' => $categories, 'categorieall' => $categorieall]);
    }
}
<?php

namespace App\Repositories;
use App\Models\Category;
use App\Models\Bill;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DB;

class PayDetailRepository
{
    public function paydetailList()
    {
        try {
            return Bill::where('checked', 1)->orderBy('id', 'desc')->paginate(8);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getListID($id)
    {
        try {
            return Post::find($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function paydetailcountList()
    {
        try {
            return Bill::where('checked', 1)->get()->count();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getPostCategory()
    {
        try {
            return Category::get();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deletePost($id) {
        try {
            Product::destroy($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

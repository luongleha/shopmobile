<?php

namespace App\Repositories;
use App\Models\Product;
use App\Models\Category;
use App\Models\Bill;
use App\Models\DetailBill;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DB;

class PayOnlineMarketRepository
{
    public function payonlineList()
    {
        try {
            return Bill::where('checked', 0)->orderBy('id', 'desc')->paginate(8);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function payonlineconfirm($id, $user)
    {
        try {
            $today = date("Y-m-d");

            $bill = Bill::find($id);
            $bill->user_id = $user;
            $bill->checked = 1; 

            $bill->save();

            $items = DetailBill::where('bill_id', $id)->get();

            foreach ($items as $key => $item) {
            $product = Product::find($item->product_id);
            $product->quantity = $product->quantity-$item->quantity;

            $product->save();
            }
            return Bill::where('checked', 0)->orderBy('id', 'desc')->paginate(8);
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

    public function payonlinecountList()
    {
        try {
            return Bill::where('checked', 0)->get()->count();
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

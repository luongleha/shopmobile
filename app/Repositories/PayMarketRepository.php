<?php

namespace App\Repositories;
use App\Models\Product;
use App\Models\Category;
use App\Models\UserInfo;
use App\Models\Bill;
use App\Models\DetailBill;
// use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;
use DB;

class PayMarketRepository
{
    public function getList()
    {
        try {
            return Product::orderBy('id', 'desc')->paginate(8);
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

    public function countList()
    {
        try {
            return Product::get()->count();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createBillOrder($data, $user, $items)
    {
        try {
            $today = date("Y-m-d");

            $userinfo = new UserInfo();
            $userinfo->fullname = $data['name'];
            $userinfo->email = $data['email'];
            $userinfo->phone = $data['phone'];
            $userinfo->address = $data['address'];

            $userinfo->save();

            $bill = new Bill();
            $bill->quantity_buy = $data['qty-product'];
            $bill->total_money = $data['totalpay-product'];
            $bill->money_taken = $data['money-taken'];
            $bill->excess_cash = $data['excess-cash'];
            $bill->userinfo_id = $userinfo->id;
            $bill->user_id = $user;
            $bill->date = $today; 
            $bill->checked = 1; 

            $bill->save();

            foreach ($items as $key => $item) {
            $billdetail = new DetailBill();
            $billdetail->bill_id = $bill->id;
            $billdetail->product_id = $item->id;
            $billdetail->quantity = $item->qty;
            $billdetail->into_money = $item->qty*$item->price;

            $billdetail->save();

            $product = Product::find($item->id);
            $product->quantity = $product->quantity-$item->qty;

            $product->save();

            Cart::destroy($item->rowId);
            }

            return Product::all();
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

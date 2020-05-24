<?php

namespace App\Repositories;
use App\Models\Bill;
use App\Models\DailySale;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DB;

class DailySalesRepository
{
    public function dailysalelList($today)
    {
        try {
            return Bill::where('date', $today)->where('checked', 1)->orderBy('id', 'desc')->get();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function dailysalecountList($today)
    {
        try {
            return Bill::where('date', $today)->where('checked', 1)->get()->count();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createDailySale($data, $user, $today, $count)
    {
        try {
            $dailysale = new DailySale();
            $dailysale->total_bill = $count;
            $dailysale->total_quantity = $data['total_quantity'];
            $dailysale->total_money = $data['total_money'];
            $dailysale->total_userinfo = $count;
            $dailysale->user_id = $user;
            $dailysale->date = $today;

            $dailysale->save();

            return DailySale::all();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showdailysalelList()
    {
        try {
            return DailySale::orderBy('id', 'desc')->get();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showdailysalecountList()
    {
        try {
            return DailySale::get()->count();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

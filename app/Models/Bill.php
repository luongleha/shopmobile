<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
	protected $fillable = [
		'product_id', 'quantity_buy', 'total_money', 'userinfo_id', 'user_id',
	];

	protected $table = 'bills';

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function userinfo() {
		return $this->belongsTo('App\Models\UserInfo');
	}

	public function detail_bill() {
		return $this->hasMany('App\Models\DetailBill', 'bill_id', 'id');
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBill extends Model
{
	protected $fillable = [
		'bill_id', 'product_id', 'quantity', 'into_money',
	];

    protected $table = 'detail_bill';

	public function bill() {
		return $this->belongsTo('App\Models\Bill', 'bill_id', 'id');
	}

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function product() {
		return $this->belongsTo('App\Models\Product', 'product_id', 'id');
	}
}

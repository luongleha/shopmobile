<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailySale extends Model
{
    protected $fillable = [
		'total_bill', 'total_quantity', 'total_money', 'total_userinfo', 'user_id', 'date',
	];

	protected $table = 'daily_sales';

	public function user() {
		return $this->belongsTo('App\Models\User');
	}
}

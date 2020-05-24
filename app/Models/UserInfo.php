<?php

namespace App\Models;

use App\Models\User;
use App\Models\Bill;
use App\Models\DailySale;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model {

	protected $table = 'userinfo';

	public function user() {
		return $this->belongsTo(User::class);
		//return $this->belongsTo('App\User');
	}

	public function bill() {
		return $this->hasMany(Bill::class);
	}

	public function dailysale() {
		return $this->hasMany(DailySale::class);
	}

}
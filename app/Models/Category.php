<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
		'name', 'parent_id', 'depth',
	];

    protected $table = 'categories';

    public function products() {
		return $this->hasMany(Product::class);
	}

	public function children()
	{
	    return $this->hasMany('Category', 'parent_id', 'id');
	}
	public function parent()
	{
	    return $this->belongsTo('Category', 'parent_id');
	}

}

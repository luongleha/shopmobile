<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable = [
		'name', 'path', 'product_id',
	];

    protected $table = 'images';

    public function products() {
        return $this->hasOne(Product::class);
    }
}

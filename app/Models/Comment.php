<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
		'product_id', 'comment_id', 'comment_content', 'reply_id', 'reply_content', 'user_name', 'user_email', 'comment_file',
	];

    public function product() {
		return $this->belongsTo(Product::class);
	}

	public function children()
  {
    return $this->hasMany(Comment::class, 'parent_id');
  }
}

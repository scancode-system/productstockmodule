<?php

namespace Modules\ProductStock\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class ProductStock extends Model
{
	protected $fillable = ['date_delivery'];


	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function getTakenAttribute()
	{
		return $this->available-$this->left;
	}


}

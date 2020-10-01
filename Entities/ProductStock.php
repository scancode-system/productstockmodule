<?php

namespace Modules\ProductStock\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\ProductStock\Entities\Stock;
use Modules\ProductStock\Entities\Traits\ProductStockTakeNowTrait;
use Modules\ProductStock\Entities\Traits\ProductStockCallStockFieldsTrait;
use Modules\ProductStock\Entities\Traits\ProductStockRepositoryTrait;
use \Exception;


class ProductStock extends Model
{

	use ProductStockTakeNowTrait;
	use ProductStockCallStockFieldsTrait;
	use ProductStockRepositoryTrait;

	protected $fillable = ['date_delivery'];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	/*public function getTakenAttribute()
	{
		return $this->available-$this->left;
	}*/


}

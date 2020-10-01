<?php

namespace Modules\ProductStock\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\ProductStock\Entities\ItemProductStock;
use Modules\ProductStock\Entities\Traits\ItemProductStockTakeNowTrait;
use Modules\ProductStock\Entities\Traits\ItemProductStockRepositoryTrait;
use Modules\ProductStock\Entities\Traits\ItemProductStockCallStockFieldsTrait;
use Modules\Order\Entities\Item;

class ItemProductStock extends Model
{
	use ItemProductStockTakeNowTrait;
	use ItemProductStockRepositoryTrait;
	use ItemProductStockCallStockFieldsTrait;


	protected $fillable = [];

	
	public function item()
	{
		return $this->belongsTo(Item::class);
	}


}

<?php

namespace Modules\ProductStock\Observers;

use Modules\Order\Entities\Item;
use Modules\ProductStock\Repositories\ProductStockRepository;

class ItemObserver
{

	public function creating(Item $item)
	{
		$product_stock = ProductStockRepository::loadByProductId($item->product_id);
		ProductStockRepository::take($product_stock, $item->qty);
	}	

	public function updating(Item $item)
	{
		$product_stock = ProductStockRepository::loadByProductId($item->product_id);
		$append_qty = $this->computeQty($item);
		ProductStockRepository::appendQty($product_stock, $append_qty);
	}

	public function deleting(Item $item)
	{
		$product_stock = ProductStockRepository::loadByProductId($item->product_id);
		ProductStockRepository::put($product_stock, $item->qty);
	}

	private function computeQty(Item $item){
		return ($item->qty-$item->getOriginal('qty'))*(-1);
	}

}

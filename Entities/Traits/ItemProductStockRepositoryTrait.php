<?php

namespace Modules\ProductStock\Entities\Traits;

use Modules\Order\Entities\Item;
use Modules\ProductStock\Entities\ItemProductStock;

trait ItemProductStockRepositoryTrait {

	public static function loadByItem(Item $item){
		return ItemProductStock::where('item_id', $item->id)->first();
	}

	public static function new($item, $quantities, $product_stock, $desired){
		$item_product_stock = new ItemProductStock();
		$item_product_stock->item_id = $item->id;

		foreach ($quantities as $key => $qty) {
			$column_left = 'qty'.$key;
			$column_date = 'date_delivery'.$key;

			$item_product_stock->$column_left = $qty;
			$item_product_stock->$column_date = $product_stock->$column_date;			
		}
		$item_product_stock->desired = $desired;

		$item_product_stock->save();
	}

}
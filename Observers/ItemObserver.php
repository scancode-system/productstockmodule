<?php

namespace Modules\ProductStock\Observers;

use Modules\Order\Entities\Item;
use Modules\ProductStock\Repositories\ProductStockRepository;
use Modules\Order\Repositories\ItemRepository;
use Modules\ProductStock\Entities\ProductStock;
use Modules\ProductStock\Entities\Stock;
use Modules\ProductStock\Entities\ItemProductStock;
use Modules\ProductStock\Entities\SettingProductStock;
use \Exception;


class ItemObserver
{

	public function creating(Item $item){
		$product_stock = ProductStock::loadByProduct($item->product);
		$result = ($product_stock->take($item->qty));

		if(!SettingProductStock::loadSetting()->block){ // regra do passar
			$item->qty = $result->quantities->sum(function ($quantity) {return $quantity;});

			 // fazer o somatorio
			if($item->qty > 0 && $item->qty < $item->product->min_qty){
				session()->forget('messages_warning.product_stock_warning');
				throw new Exception("Este produto não possui em estoque, o mínimo exigido.");
			}
		}
		$product_stock->save();
		session()->flash($item->order->id.'_new_item_quantities_stock', $result);
		//dd(session('status'));

		//session($item->order->id.'_new_item_quantities_stock', $result); // prefiro usar numa instancia global
	}

	// public function created(Item $item)
	public function created(Item $item)
	{
		$result = session()->pull($item->order->id.'_new_item_quantities_stock');
		//try{
		//	$product_stock = ProductStock::loadByProduct($item->product);
		//	$quantities = ($product_stock->take($item->qty))->quantities;
		//	$product_stock->save();

		$item_product_stock = ItemProductStock::new($item, $result->quantities, $item->product->product_stock, $result->desired);
		//} catch (Exception $e){
		//	ItemRepository::destroy($item);
		//	throw new Exception($e->getMessage()); 
		//}
	}

	public function updating(Item $item)
	{
		$product_stock = ProductStock::loadByProduct($item->product);
		$item_product_stock = ItemProductStock::loadByItem($item);

		$qty_diff = $item->qty-$item->getOriginal('qty');

		if($qty_diff >= 0){	
			$result = ($product_stock->take($qty_diff));
			if(true){ // regra do passar
				$item->qty = $item->getOriginal('qty')+$result->quantities->sum(function ($quantity) {return $quantity;});
				if($item->qty > 0 && $item->qty < $item->product->min_qty){
					throw new Exception("Este produto não possui em estoque, o mínimo exigido.");
				}
			}
			$item_product_stock->put($result->quantities);
			$item_product_stock->desired = $result->desired;
		} else {
			$quantities = ($item_product_stock->take($qty_diff*(-1)))->quantities;
			$item_product_stock->desired = 0;
			$product_stock->put($quantities);
		}
		$product_stock->save();
		$item_product_stock->save();
	}

	public function deleting(Item $item)
	{
		$item_product_stock = ItemProductStock::loadByItem($item);
		if($item_product_stock){
			$product_stock = ProductStock::loadByProduct($item->product);
			$item_product_stock = ItemProductStock::loadByItem($item);

			$qty_diff = $item->qty;

			$quantities = ($item_product_stock->take($qty_diff))->quantities;
			$product_stock->put($quantities);
			$product_stock->save();
		}
	}


}

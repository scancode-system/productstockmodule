<?php

namespace Modules\ProductStock\Repositories;

use Modules\ProductStock\Entities\ProductStock;
use Modules\Product\Entities\Product;
use \Exception;

class ProductStockRepository
{
	// LOADS
	public static function loadByProductId($product_id){
		return ProductStock::where('product_id', $product_id)->first();
	}

	public static function loadByProduct(Product $product){
		return ProductStock::where('product_id', $product->id)->first();
	}

	// CREATES
	public static function new($product_id){
		$product_stock = new ProductStock();
		$product_stock->product_id = $product_id;
		$product_stock->save();
	}

	// UPDATES
	public static function update(ProductStock $product_stock, $data){
		$product_stock->update($data);
		if(isset($data['available'])){
			$product_stock = self::updateAvailable($product_stock, $data['available']);
		}
		return $product_stock;
	}

	public static function updateAvailable(ProductStock $product_stock, $qty){
		$append_qty = $qty-$product_stock->available; 
		$product_stock->available = $qty;
		return self::appendQty($product_stock, $append_qty);
	}


	public static function appendQty(ProductStock $product_stock, $qty){
		if($qty > 0){
			return self::put($product_stock, $qty);
		} elseif($qty < 0) {
			$qty*=-1;
			return self::take($product_stock, $qty);
		}	
	}


	public static function take(ProductStock $product_stock, $qty){
		$left = $product_stock->left-$qty; 
		if($left < 0){
			throw new Exception("Máximo de unidades que pode ser retirado do(a) ".$product_stock->product->description." são ".$product_stock->left." unidades");
		}
		$product_stock->left = $left;
		return $product_stock->save();
	}


	public static function put(ProductStock $product_stock, $qty){
		$left = $product_stock->left+$qty;
		if($left > $product_stock->available){
			throw new Exception("Produto esta com estoque mais do que o foi configurado.");
		}

		$product_stock->left = $left;
		return $product_stock->save();
	}

}

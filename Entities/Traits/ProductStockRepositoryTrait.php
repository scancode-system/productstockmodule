<?php

namespace Modules\ProductStock\Entities\Traits;

use Modules\Product\Entities\Product;
use Modules\ProductStock\Entities\ProductStock;
use Modules\ProductStock\Entities\Stock;

trait ProductStockRepositoryTrait {


	public static function loadByProduct(Product $product){
		return ProductStock::where('product_id', $product->id)->first();
	}

	public static function new($product_id){
		$product_stock = new ProductStock();
		$product_stock->product_id = $product_id;
		$product_stock->available = 0;
		$product_stock->left = 0;
		$product_stock->save();
		return $product_stock;
	}

}
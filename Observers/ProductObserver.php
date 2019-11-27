<?php

namespace Modules\ProductStock\Observers;

use Modules\Product\Entities\Product;
use Modules\ProductStock\Repositories\ProductStockRepository;

class ProductObserver
{

	public function created(Product $product) {
		ProductStockRepository::new($product->id);
	}	

}

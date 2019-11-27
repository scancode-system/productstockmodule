<?php

namespace Modules\ProductStock\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Product\Entities\Product;
use Modules\ProductStock\Observers\ProductObserver;
use Modules\Order\Entities\Item;
use Modules\ProductStock\Observers\ItemObserver;

class ObserverServiceProvider extends ServiceProvider {

	public function boot() {
		Product::observe(ProductObserver::class);
		Item::observe(ItemObserver::class);
	}

	public function register() {
        //
	}

}

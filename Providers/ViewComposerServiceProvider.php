<?php

namespace Modules\ProductStock\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\ProductStock\Http\ViewComposers\EditComposer;
use Modules\ProductStock\Http\ViewComposers\Loader\Order\ViewProductStockComposer;

class ViewComposerServiceProvider extends ServiceProvider {

	public function boot() {
		// views
		View::composer([
			'product::edit', 
			'productstock::loader.products.tr', 
			'productstock::loader.products.view'], EditComposer::class);

		// loader
		View::composer('productstock::loader.order.view_product_stock', ViewProductStockComposer::class);
	}

	public function register() {
        //
	}

}

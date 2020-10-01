<?php

namespace Modules\ProductStock\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\ProductStock\Http\ViewComposers\StocksComposer;
use Modules\ProductStock\Http\ViewComposers\Pdf\PdfOrderComposer;
use Modules\ProductStock\Http\ViewComposers\Settings\SettingComposer;


class ViewComposerServiceProvider extends ServiceProvider {

	public function boot() {
		View::composer('productstock::loader.settings.body', StocksComposer::class);

		View::composer('productstock::loader.products.edit', StocksComposer::class);
		View::composer('productstock::loader.products.view', StocksComposer::class);
		View::composer('productstock::loader.products.thead', StocksComposer::class);
		View::composer('productstock::loader.products.tr', StocksComposer::class);

		View::composer('productstock::loader.order.items.info', StocksComposer::class);
		View::composer('productstock::loader.order.view', StocksComposer::class);

		View::composer('productstock::pdf.layouts.body', StocksComposer::class);
		View::composer('productstock::pdf.layouts.body', PdfOrderComposer::class);

		View::composer('productstock::pdf.layouts.body', PdfOrderComposer::class);

		View::composer('productstock::loader.settings.body', SettingComposer::class);
	}

	public function register() {
        //
	}

}

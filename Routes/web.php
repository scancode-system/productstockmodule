<?php

Route::prefix('productstock')->middleware('auth')->group(function() {
	//get
	Route::get('{product}/view_product_stock/ajax', 'ProductStockController@loadViewProductStockAjax')->name('productstock.view_product_stock.ajax');
	//put
	Route::put('{product_stock}', 'ProductStockController@update')->name('productstock.update');
});


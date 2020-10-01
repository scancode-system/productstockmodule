<?php

Route::prefix('productstock')->middleware('auth')->group(function() {
	
	Route::get('{product}/view_product_stock/ajax', 'ProductStockController@loadViewProductStockAjax')->name('productstock.view_product_stock.ajax');
	Route::put('{product_stock}', 'ProductStockController@update')->name('productstock.update');
});

Route::prefix('stocks')->middleware('auth')->group(function() {
	
	Route::post('', 'StockController@store')->name('stocks.store');
	Route::delete('{stock}', 'StockController@destroy')->name('stocks.destroy');

});

Route::prefix('setting_product_stock')->middleware('auth')->group(function() {
	Route::put('', 'SettingProductStockController@update')->name('setting_product_stock.update');
});

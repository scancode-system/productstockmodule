<?php

namespace Modules\ProductStock\Observers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Modules\ProductStock\Entities\Stock;

class StockObserver
{

	public function creating(Stock $stock) {
		$stock->sufix = '_'.Str::slug($stock->alias, '_');

		Schema::table('product_stocks', function (Blueprint $table) use($stock) {
			$table->integer('available'.$stock->sufix)->after('product_id')->default(0);
			$table->integer('left'.$stock->sufix)->after('available'.$stock->sufix)->default(0);
			$table->date('date_delivery'.$stock->sufix)->after('left'.$stock->sufix)->nullable();
		});

		Schema::table('item_product_stocks', function (Blueprint $table) use($stock) {
			$table->integer('qty'.$stock->sufix)->after('item_id')->default(0);
			$table->date('date_delivery'.$stock->sufix)->after('qty'.$stock->sufix)->nullable();
		});

	}	

	public function deleting(Stock $stock) {
		Schema::table('product_stocks', function (Blueprint $table) use($stock) {
			$table->dropColumn(['available'.$stock->sufix, 'left'.$stock->sufix, 'date_delivery'.$stock->sufix]);
		});

		Schema::table('item_product_stocks', function (Blueprint $table) use($stock) {
            $table->dropColumn(['qty'.$stock->sufix, 'date_delivery'.$stock->sufix]);
        });
	}	

}

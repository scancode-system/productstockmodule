<?php

namespace Modules\ProductStock\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Modules\Product\Entities\Product;
use Modules\ProductStock\Entities\ProductStock;
use Modules\Order\Entities\Item;
use Modules\ProductStock\Entities\ItemProductStock;

class RelationshipServiceProvider extends ServiceProvider
{


    public function boot()
    {
        Product::addDynamicRelation('product_stock', function (Product $product) {
            return $product->hasOne(ProductStock::class);
        });

        Item::addDynamicRelation('item_product_stock', function (Item $item) {
            return $item->hasOne(ItemProductStock::class);
        });
    }



    public function register()
    {

    }

}

<?php

namespace Modules\ProductStock\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\ProductStock\Repositories\ProductStockRepository;

class AfterImportProductListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $product_stock = $event->product()->product_stock;
        ProductStockRepository::update($product_stock, $event->data());
    }
}

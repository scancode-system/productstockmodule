<?php

namespace Modules\ProductStock\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\ProductStock\Repositories\ProductStockRepository;
use \PhpOffice\PhpSpreadsheet\Shared\Date;


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
        $data = $event->data();
        try {
                $data['date_delivery'] = Date::excelToDateTimeObject($data['date_delivery']);
        } catch (Exception $e) {
                // Do Nothing
        }
        $product_stock = $event->product()->product_stock;
        ProductStockRepository::update($product_stock, $event->data());
    }
}

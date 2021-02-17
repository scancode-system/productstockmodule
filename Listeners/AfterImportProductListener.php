<?php

namespace Modules\ProductStock\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Modules\ProductStock\Repositories\ProductStockRepository;
use Modules\ProductStock\Entities\Stock;
use \PhpOffice\PhpSpreadsheet\Shared\Date;


class AfterImportProductListener
{
    public static $schema = true;

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
        $index = $event->index();

        $fields_available = $this->fields($data, 'available_');


        /*foreach ($fields_available as $priority => $field) {
            $sufix = str_replace('available_', '', $field);
            if(!Schema::hasColumn('product_stocks', $field)) {
                Stock::create(['priority' => $priority, 'alias' => $sufix]);
            }
        }*/


        try {
            foreach ($fields_available as $field) {
                $field_date_delivery = str_replace('available', 'date_delivery', $field);
                $data[$field_date_delivery] = Date::excelToDateTimeObject($data[$field_date_delivery]);
            }

        } catch (Exception $e) {
                // Do Nothing
        }


        $available_fields = collect($data)->filter(
            function($value, $key){
                return (Str::contains($key, 'available'));
            });
        $dates_fields = collect($data)->filter(
            function($value, $key){
                return (Str::contains($key, 'date_delivery'));
            });        

        $product_stock = $event->product()->product_stock;
        /*if(is_null($product_stock)){
            dd($event->product());
        }*/
        $product_stock->updateAvailables($available_fields);
        $product_stock->updateDates($dates_fields->toArray());
        $product_stock->save();
    }

    private function fields($data, $search){

        $fields = collect([]);
        foreach ($data as $field => $value) {
            if(preg_match('/\b('.$search.'\w*)\b/', $field)){
                $fields->push($field);
            }
        }
        return $fields;
    }

}

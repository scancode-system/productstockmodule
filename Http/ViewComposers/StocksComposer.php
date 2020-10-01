<?php

namespace Modules\ProductStock\Http\ViewComposers;

use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ProductStock\Entities\Stock;

class StocksComposer extends ServiceComposer {

    private $stocks;

    public function assign($view){
        $this->stocks();
    }


    private function stocks(){
        $this->stocks = Stock::orderBy('priority')->get();
    }


    public function view($view){
        $view->with('stocks', $this->stocks);
    }

}
<?php

namespace Modules\ProductStock\Http\ViewComposers;


use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ProductStock\Repositories\ProductStockRepository;


class EditComposer extends ServiceComposer {

    private $product_stock;

    public function assign($view){
        $this->product_stock($view->product);
    }


    private function product_stock($product){
        $this->product_stock = ProductStockRepository::loadByProduct($product);
    }

    public function view($view){
        $view->with('product_stock', $this->product_stock);
    }

}
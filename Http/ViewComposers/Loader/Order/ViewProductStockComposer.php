<?php

namespace Modules\ProductStock\Http\ViewComposers\Loader\Order;


use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ProductStock\Repositories\ProductStockRepository;


class ViewProductStockComposer extends ServiceComposer {

    private $product_stock;

    public function assign($view){
        $this->product_stock();
    }


    private function product_stock(){
        $this->product_stock = ProductStockRepository::loadByProduct(request()->route('product'));
    }

    public function view($view){
        $view->with('product_stock', $this->product_stock);
    }

}
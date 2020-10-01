<?php

namespace Modules\ProductStock\Http\ViewComposers\Pdf;

use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ProductStock\Entities\Order;
use Modules\ProductStock\Entities\SettingProductStock;



class PdfOrderComposer extends ServiceComposer {

    private $order;
    private $count_hidden_columns;
    private $setting_product_stock;

    public function assign($view){
        $this->order($view->order);
        $this->fewerColumns($view->setting_pdf);
        $this->settingProductStock();
    }


    private function order($order){
        $this->order = Order::with(['order_client', 'order_client.order_client_address', 'order_saller', 'order_payment', 'items', 'items.item_product'])->find($order->id);
        //dd($this->order);
    }

    private function fewerColumns($setting_pdf)
    {
        $this->count_hidden_columns = $setting_pdf->count_hidden_columns;
    }

    private function settingProductStock()
    {
        $this->setting_product_stock = SettingProductStock::loadSetting();
    }

    public function view($view){
        $view->with('order', $this->order);
        $view->with('count_hidden_columns', $this->count_hidden_columns);
        $view->with('setting_product_stock', $this->setting_product_stock);
    }

}
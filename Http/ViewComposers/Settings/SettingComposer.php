<?php

namespace Modules\ProductStock\Http\ViewComposers\Settings;

use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ProductStock\Entities\SettingProductStock;


class SettingComposer extends ServiceComposer {

    private $setting_product_stock;

    public function assign($view){
        $this->setting_product_stock();
    }

    private function setting_product_stock(){
        $this->setting_product_stock = SettingProductStock::loadSetting();
    }

    public function view($view){
        $view->with('setting_product_stock', $this->setting_product_stock);
    }

}
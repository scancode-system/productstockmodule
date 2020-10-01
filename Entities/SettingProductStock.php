<?php

namespace Modules\ProductStock\Entities;

use Illuminate\Database\Eloquent\Model;

class SettingProductStock extends Model
{
	protected $table = 'setting_product_stock';
    protected $fillable = ['block', 'desired'];

    public static function updateSetting($data){
    	//dd($data);
    	if(SettingProductStock::count() == 0){
    		$setting_product_stock = SettingProductStock::create([]);
    	} else {
    		$setting_product_stock = SettingProductStock::loadSetting();
    	}
    	$setting_product_stock->update($data);
    	return $setting_product_stock;
    }

	public static function loadSetting(){
    	if(SettingProductStock::count() == 0){
    		return SettingProductStock::create([]);
    	} else {
    		return SettingProductStock::first(); 
    	}
    }    
}

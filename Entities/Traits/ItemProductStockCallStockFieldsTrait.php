<?php

namespace Modules\ProductStock\Entities\Traits;


use Modules\ProductStock\Entities\Stock;

trait ItemProductStockCallStockFieldsTrait {


	public function qty(Stock $stock)
	{
		return $this->{$stock->qty_field_name};
	}

	public function dateDelivery(Stock $stock)
	{
		return $this->{$stock->date_delivery_field_name};
	}

	public function totalGross(Stock $stock)
	{
		return ($this->item->price*$this->qty($stock));
	}

	public function totalDiscountValue(Stock $stock)
	{
		return $this->item->discount_value*$this->qty($stock);
	}

	public function totalAdditionValue(Stock $stock)
	{
		return $this->item->addition_value*$this->qty($stock);
	}

	public function total(Stock $stock)
	{
		return $this->item->price_net*$this->qty($stock);
	}



	/*	public function getTotalNowAttribute($value)
	{
		return $this->price_net*$this->item_product_stock_now_after->qty_now;
	}

	public function getTotalGrossNowAttribute($value)
	{
		return $this->price*$this->item_product_stock_now_after->qty_now;
	}


	public function getTotalDiscountValueNowAttribute($value)
	{
		return $this->discount_value*$this->item_product_stock_now_after->qty_now;
	}


	public function getTotalAdditionValueNowAttribute($value)
	{
		return $this->addition_value*$this->item_product_stock_now_after->qty_now;;
	}





	public function getTotalAfterAttribute($value)
	{
		return $this->price_net*$this->item_product_stock_now_after->qty_after;
	}

	public function getTotalGrossAfterAttribute($value)
	{
		return $this->price*$this->item_product_stock_now_after->qty_after;
	}


	public function getTotalDiscountValueAfterAttribute($value)
	{
		return $this->discount_value*$this->item_product_stock_now_after->qty_after;
	}

	public function getTotalAdditionValueAfterAttribute($value)
	{
		return $this->addition_value*$this->item_product_stock_now_after->qty_after;
	}	*/

}
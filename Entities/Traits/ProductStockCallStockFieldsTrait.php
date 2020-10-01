<?php

namespace Modules\ProductStock\Entities\Traits;

use Modules\ProductStock\Entities\Stock;


trait ProductStockCallStockFieldsTrait {


	/*public function availablePropertie($sufix)
	{
		return 'available'.$sufix;
	}*/

	public function available(Stock $stock)
	{
		return $this->{$stock->available_field_name};
		//return $this->{$this->availablePropertie($sufix)};
	}

	/*public function dateDeliveryPropertie($sufix)
	{
		return 'date_delivery'.$sufix;
	}*/

	public function dateDelivery(Stock $stock)
	{
		return $this->{$stock->date_delivery_field_name};
		//return $this->{$this->dateDeliveryPropertie($sufix)};
	}

	/*public function leftPropertie($sufix)
	{
		return 'left'.$sufix;
	}*/

	public function left(Stock $stock)
	{
		return $this->{$stock->left_field_name};
		//return $this->{$this->leftPropertie($sufix)};
	}

	public function taken(Stock $stock)
	{
		return $this->available($stock)-$this->left($stock);
	}


}
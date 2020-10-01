<?php

namespace Modules\ProductStock\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Order\Entities\Order as OrderBase;
use Modules\Order\Entities\Item;
use Rocky\Eloquent\HasDynamicRelation;

class Order extends OrderBase
{

	use HasDynamicRelation;

	public function itemsStock($stock)
	{
		return $this->hasMany(Item::class)->whereHas('item_product_stock', function($query) use($stock) {
			$query->where('qty'.$stock->sufix, '>', 0);
		})->get();
	}


	public function totalItems($stock)
	{
		return $this->itemsStock($stock)->count();
	}

	public function totalUnits($stock)
	{
		$sum = 0;
		foreach ($this->itemsStock($stock) as $item) {
			$sum+= $item->item_product_stock->qty($stock);
		}
		return $sum;
	}


	public function total($stock)
	{
		$sum = 0;
		foreach ($this->itemsStock($stock) as $item) {
			$sum+= $item->item_product_stock->total($stock);
		}
		return $sum;
	}


	public function totalGross($stock)
	{
		$sum = 0;
		foreach ($this->itemsStock($stock) as $item) {
			$sum+= $item->item_product_stock->totalGross($stock);
		}
		return $sum;
	}


	public function discountValue($stock)
	{
		$sum = 0;
		foreach ($this->itemsStock($stock) as $item) {
			$sum+= $item->item_product_stock->totalDiscountValue($stock);
		}
		return $sum;
	}

	public function additionValue($stock)
	{
		$sum = 0;
		foreach ($this->itemsStock($stock) as $item) {
			$sum+= $item->item_product_stock->totalAdditionValue($stock);
		}
		return $sum;
	}

}

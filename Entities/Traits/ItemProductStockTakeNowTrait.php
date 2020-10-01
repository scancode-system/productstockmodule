<?php

namespace Modules\ProductStock\Entities\Traits;

use \Exception;
use Modules\ProductStock\Entities\Stock;

trait ItemProductStockTakeNowTrait {

public function put($quantities){
		foreach ($quantities as $key => $qty) {
			$column_left = 'qty'.$key;
			$this->$column_left += $qty;
		}
	}

	public function take($qty){
		$result = $this->takeFromOtherStocks($qty, Stock::orderBy('priority', 'desc')->get());
		if(!$result->available){
			$qty_result = $result->qty;

			$left = $this->qty-$qty_result;

			if($left >= 0) {
				$this->qty = $left;
				$result->quantities->put('', $qty_result);
			} else {
				throw new Exception("A quantidade no item deste pedido é menor do que o que se pretende devolver.");
			}
		}
		$this->save();
		return $result;

	}

	public function takeFromOtherStocks($qty, $stocks){
		// se chegar no estoque base
		if($stocks->count() == 0){
			return (object)['available' => false, 'quantities' => collect([]), 'qty' => $qty];
		}

		$stock = $stocks->first();
		$stocks->shift();

		$propertie = 'qty'.$stock->sufix;

		$left = $this->$propertie - $qty;
		if($left < 0){
			$qty = $this->$propertie;
			$this->$propertie = 0;
			$result = $this->takeFromOtherStocks($left *(-1), $stocks); 
			$result->quantities->put($stock->sufix, $qty);
			return $result;
		} else { // se no estoque mais acima conseguiu retornar tudo 
			$this->$propertie = $left;
			return (object)['available' => true, 'quantities' => collect([$stock->sufix => $qty])];
			return true;
		}
	}


}
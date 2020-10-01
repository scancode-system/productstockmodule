<?php

namespace Modules\ProductStock\Entities\Traits;

use Modules\ProductStock\Entities\Stock;
use Modules\ProductStock\Entities\SettingProductStock;
use \Exception;

trait ProductStockTakeNowTrait {


	public function updateAvailables($availables){
		foreach ($availables as $propertie => $available) {
			$qty_diff = $available-$this->$propertie;
			$this->$propertie = $available;

			if($qty_diff >= 0){
				$this->put([str_replace('available', '',$propertie) => $qty_diff]);
			} else {
				$qty_diff *= -1;
				$stock = Stock::loadBySufix(str_replace('available', '', $propertie));
				$this->takingStocks($qty_diff, collect([$stock]));
			}
		}
	}

	public function take($qty){
		return $this->takingStocks($qty, Stock::orderBy('priority')->get(), $qty);
	}

	public function takingStocks($qty, $stocks, $qty_original){
		if($stocks->count() == 0){
			if(!SettingProductStock::loadSetting()->block){ // regra do passar
				if(SettingProductStock::loadSetting()->desired){ // regra do desejado
					session()->flash('messages_warning.product_stock_warning', 'Não foi possível colocar toda a quantidade selecionada. Foram colocados '.$qty.' unidades como desejado');
					return (object)['quantities' => collect([]), 'desired' => $qty];
				} else {
					session()->flash('messages_warning.product_stock_warning', 'Não foi possível colocar toda a quantidade selecionada. Foi para a sacola '.$qty_original.' unidades.');
					return (object)['quantities' => collect([]), 'desired' => 0];
				}
			}
			throw new Exception("Não há estoque suficiente para ser retirado.");
		}

		$stock = $stocks->first();
		$stocks->shift();

		$propertie = 'left'.$stock->sufix;

		$left = $this->$propertie - $qty;
		if($left < 0){
			$qty = $this->$propertie;
			$this->$propertie = 0;
			$result = $this->takingStocks($left *(-1), $stocks, $qty_original); 
			$result->quantities->put($stock->sufix, $qty);
			return $result;
		} else { 
			$this->$propertie = $left;
			return (object)[/*'available' => true, */'quantities' => collect([$stock->sufix => $qty]), 'desired' => 0];
		}
	}

	public function put($quantities){
		foreach ($quantities as $propertie => $qty) {
			$field_left = 'left'.$propertie;
			$available_left = 'available'.$propertie;
			if(($qty+$this->$field_left) > $this->$available_left){
				throw new Exception("Produto está com estoque mais do que o foi configurado.");
			}
			$this->$field_left += $qty;
		}
	}

	public function updateDates($dates){
		foreach ($dates as $field => $date) {
			$this->$field = $date;
		}
		
	}


}
<?php

namespace Modules\ProductStock\Entities;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['id', 'sufix', 'alias', 'priority'];


    public static function deleteBySufix($sufix){
    	Stock::where('sufix', $sufix)->delete();
    }

    public static function loadBySufix($sufix){
    	return Stock::where('sufix', $sufix)->first();
    }

    public function getAvailableFieldNameAttribute($value)
    {
        return 'available'.$this->sufix;
    }

    public function getLeftFieldNameAttribute($value)
    {
        return 'left'.$this->sufix;
    }

    public function getDateDeliveryFieldNameAttribute($value)
    {
        return 'date_delivery'.$this->sufix;
    }

    public function getQtyFieldNameAttribute($value)
    {
        return 'qty'.$this->sufix;
    }

}

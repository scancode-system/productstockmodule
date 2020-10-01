<?php

namespace Modules\ProductStock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Modules\ProductStock\Entities\Stock;

class ProductStockRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = collect([]);
        foreach (Stock::all() as $stock) {
            $rules->put('available'.$stock->sufix, 'integer|min:0');
            $rules->put('date_delivery'.$stock->sufix, 'nullable|date');
        }

        return $rules->toArray();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function passedValidation(){
        $available_fields = collect($this->all())->filter(
            function($value, $key){
                return (Str::contains($key, 'available'));
            });
        $dates_fields = collect($this->all())->filter(
            function($value, $key){
                return (Str::contains($key, 'date_delivery'));
            });

        $this->merge([
            'available_fields' => $available_fields,
            'dates_fields' => $dates_fields
        ]);
    }
}

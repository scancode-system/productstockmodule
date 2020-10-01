<?php

namespace Modules\ProductStock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Client\Repositories\SettingClientRepository;

class StockRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'priority' => 'required|integer|min:0|unique:stocks,priority',
            'alias' => 'required|string|max:191'
        ];
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
}

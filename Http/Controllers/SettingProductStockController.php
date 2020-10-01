<?php

namespace Modules\ProductStock\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ProductStock\Entities\SettingProductStock;

class SettingProductStockController extends Controller
{

    public function update(Request $request)
    {
        SettingProductStock::updateSetting($request->all());
        return back()->with('success', 'Configuração atualizada.');
    }

}

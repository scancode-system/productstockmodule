<?php

namespace Modules\ProductStock\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ProductStock\Entities\Stock;
use Modules\ProductStock\Http\Requests\StockRequest;


class StockController extends Controller
{

    public function store(StockRequest $request)
    {
        Stock::create($request->all());
        return back()->with('success', 'Novo Estoque adicionado.');
    }

    public function destroy(Request $request, Stock $stock)
    {
        $stock->delete();
        return back()->with('success', 'Estoque removido.');
    }

}

<?php

namespace Modules\ProductStock\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ProductStock\Entities\Stock;

class StockController extends Controller
{
   
    public function load()
    {
        return Stock::orderBy('priority', 'desc')->get();
    }

}

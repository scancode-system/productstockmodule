<?php

namespace Modules\ProductStock\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ProductStock\Entities\ProductStock;
use Modules\Product\Entities\Product;
use Modules\ProductStock\Repositories\ProductStockRepository;
use Modules\ProductStock\Http\Requests\ProductStockRequest;
use \Exception;

class ProductStockController extends Controller
{

    public function update(ProductStockRequest $request, ProductStock $product_stock){
        try{
            ProductStockRepository::update($product_stock, $request->all());
            return redirect()->route('products.edit', $product_stock->product)->with('success', 'Estoque atualizado.');
        } catch (Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }


    public function loadViewProductStockAjax(Request $request, Product $product){
    	return view('productstock::loader.order.view_product_stock');
    }

}

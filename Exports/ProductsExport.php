<?php 
namespace Modules\ProductStock\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Product\Repositories\ProductRepository;
use Modules\Order\Repositories\ItemRepository;

use Modules\ProductStock\Entities\ItemProductStock;
use Modules\ProductStock\Entities\Stock;


class ProductsExport implements FromCollection, WithStrictNullComparison, ShouldAutoSize
{
    public function collection()
    {
        return new Collection($this->data());
    }


    private function data(){
        return array_merge($this->header(), $this->body());
    }


    private function header(){
        return [
            collect([
                'Referência', 
                'Descrição', 
                'Categoria', 
                'Preço'])->
            merge($this->headerStock())->
            merge([
                'Unidades Vendidas', 
                'Total Bruto', 
                'Total de Descontos', 
                'Total de Acréscimos', 
                'Total Final'])
        ];
    }

    private function headerStock(){
        $headerStock = collect([]);
        foreach (Stock::orderBy('priority')->get() as $stock) {
            $headerStock = $headerStock->merge([
                $stock->alias.' - Unidades Disponibilizada', 
                $stock->alias.' - Unidades Vendidas', 
                $stock->alias.' - Unidades Restantes', 
                $stock->alias.' - Data Entrega', 
                $stock->alias.' - Total Bruto', 
                $stock->alias.' - Total de Descontos', 
                $stock->alias.' - Total de Acréscimos', 
                $stock->alias.' - Total Final'
            ]);
        }
        return $headerStock;
    }


    private function body(){
        $products = ProductRepository::loadAll();
        $body = [];

        foreach ($products as $product) {
            $row = collect(['
                referencia' => $product->sku,
                'descricao' => $product->description,
                'categoria' => $product->category,
                'preco' => $product->price])->
            merge($this->bodyStock($product))->
            merge([
                'quantidade' => 0,
                'total_bruto' => 0,
                'desconto_valor' => 0,
                'acrescimo_valor' => 0,
                'total' => 0])->
            toArray();

            $row = (object) $row;

            $items = ItemRepository::loadSoldItemsByProduct($product);

            foreach ($items as $item) {
                $item_product_stock = ItemProductStock::loadByItem($item);

                foreach (Stock::orderBy('priority')->get() as $stock) {
                    $row->{'qty_sold'.$stock->sufix} += $item->item_product_stock->qty($stock);
                    $row->{'total_gross'.$stock->sufix} += round($item_product_stock->totalGross($stock), 2);
                    $row->{'total_discount_value'.$stock->sufix} += round($item_product_stock->totalDiscountValue($stock), 2);
                    $row->{'total_addition_value'.$stock->sufix} += round($item_product_stock->totalAdditionValue($stock), 2);
                    $row->{'total'.$stock->sufix} += round($item_product_stock->total($stock), 2);
                }

                $row->quantidade += $item->qty;
                $row->total_bruto += round($item->total_gross, 2);
                $row->desconto_valor += round($item->total_discount_value, 2);
                $row->acrescimo_valor += round($item->total_addition_value, 2);
                $row->total += round($item->total, 2);
            }

            array_push($body, $row);
        }

        return (new Collection($body))->sortByDesc('total')->toArray();

    }

    public function bodyStock($product){
        $bodyStock = collect([]);
        foreach (Stock::orderBy('priority')->get() as $stock) {
            $bodyStock = $bodyStock->merge([
                $product->product_stock->{$stock->available_field},
                'qty_sold'.$stock->sufix => 0,
                $product->product_stock->{$stock->left_field},
                $product->product_stock->{$stock->date_delivery_field}, 
                'total_gross'.$stock->sufix => 0,
                'total_discount_value'.$stock->sufix => 0, 
                'total_addition_value'.$stock->sufix => 0, 
                'total'.$stock->sufix => 0, 
            ]);
        }
        return $bodyStock;
    }

}
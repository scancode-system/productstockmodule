<hr>
@foreach($stocks as $stock)
<div class="row mt-2">
	<div class="col border-rigt text-left py-0"><h5>Estoque {{ $stock->alias }}</h5></div>
	<div class="col text-left py-0"><h5>{{ $product->product_stock->left($stock) }} Unidades</h5></div>
</div>
@endforeach
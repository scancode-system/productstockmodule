<hr />
@foreach($stocks as $stock)
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Estoque {{ $stock->alias }}:</strong></div>
	<div class="col">{{ $item->item_product_stock->qty($stock) }}</div>
</div>
@endforeach
<hr />
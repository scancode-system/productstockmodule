@foreach($stocks as $stock)
<div class="row justify-content-center mb-1">
	<div class="col-md-4"><strong>Estoque {{ $stock->alias }}: </strong></div>
	<div class="col-md-4">{{ $product->product_stock->left($stock) }}</div>
</div>
@endforeach

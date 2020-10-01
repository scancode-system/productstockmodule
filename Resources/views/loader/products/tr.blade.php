@foreach($stocks as $stock)
<td class="align-middle text-center">{{ $product->product_stock->left($stock) }}</td>
@endforeach

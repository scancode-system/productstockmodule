@foreach($stocks as $stock)
@if($order->itemsStock($stock)->count() > 0)
<table class="w-100 mb-3"> 
	<thead>
		<tr>
			<th  colspan="{{ 7+$count_show_columns }}" class="border-bottom border-top border-dark border-left border-right p-2">Items do Estoque: {{ $stock->alias }}</th>
		</tr>
		<tr>
			@if($setting_pdf_image->show)
			<th class="border-bottom border-top border-dark border-left p-2">Img</th>
			@endif
			<th class="border-bottom border-top border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">Ref</th>
			<th class="border-bottom border-top border-dark p-2">Descrição</th>
			@loader(['loader_path' => 'pdf.items.thead'])
			<th class="border-bottom border-top border-dark p-2 text-center">Preço</th>
			@if($setting_pdf_discount->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Desc</th>
			@endif
			@if($setting_pdf_addition->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Acres</th>
			@endif
			@if($setting_pdf_taxes->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Impostos</th>
			@endif
			<th class="border-bottom border-top border-dark p-2 text-center">Prç Liq</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Quant</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Total</th>
			<th class="border-bottom border-top border-dark border-right p-2 text-center">Entrega</th>
		</tr>
	</thead>  
	<tbody>
		@foreach($order->itemsStock($stock) as $item)
		<tr>
			@if($setting_pdf_image->show)
			<td class="border-bottom border-left border-dark p-2">
				<img src="{{ url($item->item_product->image) }}" class="width-75">
			</td>
			@endif
			<td class="border-bottom border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">{{ $item->item_product->sku }}</td>
			<td class="border-bottom border-dark p-2">
				{{ $item->item_product->description }}
				<small class="text-info">{{ $item->observation }}</small>
			</td>
			@loader(['loader_path' => 'pdf.items.tr'])
			<td class="border-bottom border-dark text-center p-2">@currency($item->price)</td>
			@if($setting_pdf_discount->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->discount_value)<br>
				<small>(@percentage($item->discount))</small>
			</td>
			@endif
			@if($setting_pdf_addition->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->addition_value)<br>
				<small>(@percentage($item->addition))</small>
			</td>
			@endif
			@if($setting_pdf_taxes->show)
			<td class="border-bottom border-dark text-center p-2">
				@foreach($item->taxes as $tax)
				@currency($tax->value)<br>
				<small>{{ $tax->name }} - @percentage($tax->porcentage)</small>
				@endforeach
			</td>
			@endif
			<td class="border-bottom border-dark text-center p-2">@currency($item->price_net)</td>
			<td class="border-bottom border-dark text-center p-2">{{ $item->item_product_stock->qty($stock) }}</td>
			<td class="border-bottom border-dark text-center p-2">@currency($item->item_product_stock->total($stock))</td>
			<td class="border-bottom border-right border-dark text-center p-2">{{ $item->item_product_stock->dateDelivery($stock) ?? 'N/A' }}</td>
		</tr> 
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th class="border-bottom border-dark border-left p-2" colspan="{{ 4+$count_show_columns }}">Totais</th>
			<th class="border-bottom border-dark p-2 text-center">{{ $order->totalUnits($stock) }}</th>
			<th class="border-bottom border-dark  p-2 text-center">@currency($order->total($stock))</th>
			<th class="border-bottom border-dark border-right p-2 text-center"></th>
		</tr>
	</tfoot>
</table>
@endif
@endforeach



@if($setting_product_stock->desired)

<table class="w-100 mb-3"> 
	<thead>
		<tr>
			<th  colspan="{{ 7+$count_show_columns }}" class="border-bottom border-top border-dark border-left border-right p-2">Desejados</th>
		</tr>
		<tr>
			@if($setting_pdf_image->show)
			<th class="border-bottom border-top border-dark border-left p-2">Img</th>
			@endif
			<th class="border-bottom border-top border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">Ref</th>
			<th class="border-bottom border-top border-dark p-2">Descrição</th>
			@loader(['loader_path' => 'pdf.items.thead'])
			<th class="border-bottom border-top border-dark p-2 text-center">Preço</th>
			@if($setting_pdf_discount->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Desc</th>
			@endif
			@if($setting_pdf_addition->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Acres</th>
			@endif
			@if($setting_pdf_taxes->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Impostos</th>
			@endif
			<th class="border-bottom border-top border-dark p-2 text-center">Prç Liq</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Quant</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Total</th>
			<th class="border-bottom border-top border-dark border-right p-2 text-center">Entrega</th>
		</tr>
	</thead>  
	<tbody>
		@foreach($order->itemsStock($stock) as $item)
		@if($item->item_product_stock->desired > 0)
		<tr>
			@if($setting_pdf_image->show)
			<td class="border-bottom border-left border-dark p-2">
				<img src="{{ url($item->item_product->image) }}" class="width-75">
			</td>
			@endif
			<td class="border-bottom border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">{{ $item->item_product->sku }}</td>
			<td class="border-bottom border-dark p-2">
				{{ $item->item_product->description }}
				<small class="text-info">{{ $item->observation }}</small>
			</td>
			@loader(['loader_path' => 'pdf.items.tr'])
			<td class="border-bottom border-dark text-center p-2">@currency($item->price)</td>
			@if($setting_pdf_discount->show)
			<td class="border-bottom border-dark text-center p-2">
				N/A
			</td>
			@endif
			@if($setting_pdf_addition->show)
			<td class="border-bottom border-dark text-center p-2">
				N/A
			</td>
			@endif
			@if($setting_pdf_taxes->show)
			<td class="border-bottom border-dark text-center p-2">
				N/A
			</td>
			@endif
			<td class="border-bottom border-dark text-center p-2">@currency($item->price_net)</td>
			<td class="border-bottom border-dark text-center p-2">{{ $item->item_product_stock->desired }}</td>
			<td class="border-bottom border-dark text-center p-2">N/A</td>
			<td class="border-bottom border-right border-dark text-center p-2">N/A</td>
		</tr> 
		@endif
		@endforeach
	</tbody>
</table>

@endif
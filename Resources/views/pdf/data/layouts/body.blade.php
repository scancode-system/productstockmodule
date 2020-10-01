@if($order->items_stock_now->count() > 0)
<table class="w-100 mb-3">
	<thead>
		<tr>
			<th  colspan="{{ 6+$count_show_columns }}" class="border-bottom border-top border-dark border-left border-right p-2">Itens do Estoque Atual</th>
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
			<th class="border-bottom border-right border-top border-dark p-2 text-center">Total</th>
		</tr>
	</thead>  
	<tbody>
		@foreach($order->items_stock_now as $item)
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
			<td class="border-bottom border-dark text-center p-2">{{ $item->item_product_stock_now_after->qty_now }}</td>
			<td class="border-bottom border-right border-dark text-center p-2">@currency($item->total_now)</td>
		</tr> 
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th class="border-bottom border-dark border-left p-2" colspan="{{ 3+$count_show_columns }}">Totais</th>
			<th class="border-bottom border-dark p-2 text-center">{{ $order->total_units_now }}</th>
			<th class="border-bottom border-dark  p-2 text-center">@currency($order->total_now)</th>
			<th class="border-bottom border-dark border-right p-2 text-center"></th>
		</tr>
	</tfoot>
</table>
@endif



@foreach($order->dates as $key => $date)

<table class="w-100 mb-3">
	<thead>
		<tr>
			<th  colspan="{{ 6+$count_show_columns }}" class="border-bottom border-top border-dark border-left border-right p-2">
				@php setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); @endphp
				@if(($date['items'][0])->item_product_stock_now_after->date_delivery_after)
				{{ ($date['items'][0])->item_product_stock_now_after->date_delivery_after->formatLocalized('%B de %Y')
			}}
			@else
				Data Indefinida
			@endif

		</th>
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
		<th class="border-bottom border-right border-top border-dark p-2 text-center">Total</th>
	</tr>
</thead> 
<tbody>
	@foreach($date['items'] as $item)
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
		<td class="border-bottom border-dark text-center p-2">{{ $item->item_product_stock_now_after->qty_after }}</td>
		<td class="border-bottom border-right border-dark text-center p-2">@currency($item->total_after)</td>
	</tr> 
	@endforeach
</tbody>
<tfoot>
	<tr>
		<th class="border-bottom border-dark border-left p-2" colspan="{{ 3+$count_show_columns }}">Totais</th>
		<th class="border-bottom border-dark p-2 text-center">{{ $date['units'] }}</th>
		<th class="border-bottom border-dark  p-2 text-center">@currency($date['total'])</th>
		<th class="border-bottom  border-dark border-right p-2 text-center"></th>
	</tr>
</tfoot>
</table>
@endforeach

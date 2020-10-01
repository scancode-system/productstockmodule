<hr>
<h4>Estoque</h4>
@foreach($stocks as $stock)
<div class="brand-card">
	<div class="brand-card-header bg-info h-auto py-2">
		<h2 class="text-white text-capitalize">Estoque {{ $stock->alias }}</h2>
	</div>
	<div class="brand-card-body">
		<div class="lead">
			Disponíveis <br>{{ $product->product_stock->left($stock) }}
		</div>
		<div class="lead">
			Retirados <br>{{ $product->product_stock->taken($stock) }}
		</div>
	</div>
</div>
@endforeach

{{ Form::model($product->product_stock, ['route' => ['productstock.update', $product->product_stock], 'method' => 'put']) }}
@foreach($stocks as $stock)

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label($stock->availableFieldName, 'Total Disponibilizado '. $stock->alias) }}
			{{ Form::number($stock->availableFieldName, $product->product_stock->available($stock), ['class' => 'form-control']) }}
		</div>		
	</div>
	<div class="col-md-6">
		{{ Form::label($stock->date_delivery_field_name, 'Data de entrega '. $stock->alias) }}
		{{ Form::date($stock->date_delivery_field_name, $product->product_stock->dateDelivery($stock), ['class' => 'form-control']) }}
	</div>
</div>

@endforeach
{{ Form::button('<i class="fa fa-save"></i><span>Salvar Estoque</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
{{ Form::close() }}


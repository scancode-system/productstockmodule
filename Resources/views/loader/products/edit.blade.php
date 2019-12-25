<hr>
<h4>Estoque</h4>
<div class="brand-card">
	<div class="brand-card-header bg-info h-auto py-2">
		<h2 class="text-white text-capitalize">Informações de Estoque</h2>
	</div>
	<div class="brand-card-body">
		<div class="lead">
			Disponíveis <br>{{ $product->product_stock->left }}
		</div>
		<div class="lead">
			Retirados <br>{{ $product->product_stock->taken }}
		</div>
	</div>
</div>

{{ Form::model($product->product_stock, ['route' => ['productstock.update', $product->product_stock], 'method' => 'put']) }}
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('available', 'Total Disponibilizado') }}
			{{ Form::number('available', $product->product_stock->available, ['class' => 'form-control']) }}
		</div>		
	</div>
	<div class="col-md-6">
		{{ Form::label('date_delivery', 'Data de entrega') }}
		{{ Form::date('date_delivery', $product->product_stock->date_delivery, ['class' => 'form-control']) }}
	</div>
</div>
{{ Form::button('<i class="fa fa-save"></i><span>Salvar Estoque</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
{{ Form::close() }}
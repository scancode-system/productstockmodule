<div class="tab-pane {{ ($tab=='stock_setting')?'show active':'' }}" >
	@alert_errors()
	@alert_success()

	<div class="row">
		<div class="col">
			{{ Form::open(['route' => 'stocks.store']) }}
			<div class="form-group">
				{{ Form::number('priority', null, ['class' => 'form-control', 'placeholder' => 'Prioridade']) }}
			</div>
			<div class="form-group">
				{{ Form::text('alias', null, ['class' => 'form-control', 'placeholder' => 'Apelido']) }}
			</div>
			{{ Form::button('<i class="fa fa-save"></i><span>Salvar</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
			{{ Form::close() }}
			<hr>
			{{ Form::model($setting_product_stock, ['route' => 'setting_product_stock.update', 'method' => 'put']) }}
			<div class="form-group row">
				{{ Form::label('block', 'Bloquear', ['class' => 'col-sm-4 col-form-label']) }}
				<div class="col-sm-8">
					<label class="switch switch-primary switch-lg mb-0 ml-3">
						{{ Form::hidden('block', 0) }}
						{{ Form::checkbox('block', 1, null,['class' => 'switch-input']) }}
						<span class="switch-slider"></span>
					</label>
				</div>
			</div>
			<div class="form-group row">
				{{ Form::label('desired', 'Desejado', ['class' => 'col-sm-4 col-form-label']) }}
				<div class="col-sm-8">
					<label class="switch switch-primary switch-lg mb-0 ml-3">
						{{ Form::hidden('desired', 0) }}
						{{ Form::checkbox('desired', 1, null,['class' => 'switch-input']) }}
						<span class="switch-slider"></span>
					</label>
				</div>
			</div>
			{{ Form::button('<i class="fa fa-save"></i><span>Salvar</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}	
			{{ Form::close() }}
		</div>
		<div class="col">
			<table class="table table-responsive-sm bg-white table-hover border">
				<thead>
					<tr>
						<th>#</th>
						<th>Prirodade</th>
						<th>Apelido</th>
						<th class="text-right">Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach($stocks as $stock)
					<tr>
						<td class="align-middle">#{{ $stock->id }}</td>
						<td class="align-middle">{{ $stock->priority }}</td>
						<td class="align-middle">{{ $stock->alias }}</td>
						<td class="text-right align-middle">
							<div class="btn-group" role="group" aria-label="Basic example">
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#stocks_destroy_{{ $stock->id }}"><i class="fa fa-trash-o"></i></button>
							</div>
						</td>
						@modal_destroy(['route_destroy' => 'stocks.destroy', 'model' => $stock, 'modal_id' => 'stocks_destroy_'.$stock->id])
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div> 
<div id="{{ $modal_id }}_container_view_product_stock">

</div>
<div id="teste"></div>

@push('scripts')
<script>
	$(document).ready(function(){
		@if(!isset($item))
		$('#select_products').change(function(){
			$("#{{ $modal_id }}_container_view_product_stock").load("{{ url('/') }}/productstock/"+this.value+"/view_product_stock/ajax");
		});
		@else
			$("#{{ $modal_id }}_container_view_product_stock").load("{{ url('/') }}/productstock/{{ $item->product_id }}/view_product_stock/ajax");
		@endif
	});
</script>
@endpush
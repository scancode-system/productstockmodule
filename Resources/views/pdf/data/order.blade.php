@extends('pdf::pdf.layouts.master')

@section('content')
<style>
	.width-5{width: 5px;}
	.width-10{width: 10px;}
	.width-15{width: 15px;}
	.width-20{width: 20px;}
	.width-75{width: 75px;}
	.width-130{width: 130px;}

	.height-200{height: 200px;}
	.height-50{height: 50px;}
	.height-75{height: 75px;}

	.w-65{width: 65%}

	.fs-15{font-size: 15px;}
	.fs-20{font-size: 20px;}
	.fs-25{font-size: 25px;}
	.fs-30{font-size: 30px;}

	thead{display: table-header-group;}
	tfoot {display: table-row-group;}
	tr {page-break-inside: avoid;}

</style>
@include('pdf::pdf.layouts.header')
@include('productstocknowafter::pdf.data.layouts.body')
@include('pdf::pdf.layouts.footer')
@endsection

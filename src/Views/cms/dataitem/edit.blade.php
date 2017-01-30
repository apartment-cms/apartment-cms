@extends('apartment-cms::cms.layouts.master')


@section('content')
	<h4>Edit Data Item</h4>
	<form action="/admin/data-item/{{$item->slug}}" method="POST">
		{!! Form::token(); !!}
		
		{!! FormMaker::fromObject($item, Config::get('apartment.forms.dataItem')) !!}

		<hr />

		<input type="hidden" name="bucket_id" value="{{$item->bucket_id}}" />
		<input type="submit" name="submit" value="Save" />
	</form>
@endsection
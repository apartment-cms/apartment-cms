@extends('apartment-cms::cms.layouts.master')


@section('content')
	<h4>Add to {{$bucket->name}}</h4>
	<form method="POST" action="/admin/bucket/{{$bucket->id}}/data-item">
		{!! Form::token(); !!}
		{!! FormMaker::fromTable('data_items', Config::get('apartment.forms.dataItem')) !!}
		
		<input type="hidden" name="bucket_id" value="{{$bucket->id}}" />
		<input type="submit" name="submit" value="Save" />
	</form>
@endsection
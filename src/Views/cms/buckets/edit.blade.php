@extends('apartment-cms::cms.layouts.master')


@section('content')
	<h4>Bucket Information</h4>
	<form action="/admin/buckets/{{$bucket->slug}}" method="POST">
		{!! Form::token(); !!}
		
		{!! FormMaker::fromObject($bucket, Config::get('apartment.forms.bucket')) !!}
		
		<input type="submit" name="submit" value="Save" />
	</form>

	<hr />

	<h4>Contents</h4>
	@foreach( $bucket->items as $item )
		<p>{{$item->name}} <a href="/admin/data-item/{{$item->slug}}">Edit</a></p>
	@endforeach

	<a href="/admin/bucket/{{$bucket->id}}/data-item">Add new item</a>
@endsection
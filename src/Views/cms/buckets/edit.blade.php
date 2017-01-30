@extends('apartment-cms::cms.layouts.master')


@section('content')
	<form action="/admin/buckets/{{$bucket->slug}}" method="POST">
		{!! Form::token(); !!}
		
		{!! FormMaker::fromObject($bucket, Config::get('apartment.forms.bucket')) !!}
		
		<hr />	
		
		<input type="submit" name="submit" value="Save" />
	</form>
@endsection
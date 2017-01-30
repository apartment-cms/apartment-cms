@extends('apartment-cms::cms.layouts.master')


@section('content')
	<form method="POST" action="/admin/buckets">
		{!! Form::token(); !!}
		{!! FormMaker::fromTable('buckets', Config::get('apartment.forms.bucket')) !!}
		
		<input type="submit" name="submit" value="Save" />
	</form>
@endsection
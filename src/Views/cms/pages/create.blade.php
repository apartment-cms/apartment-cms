@extends('apartment-cms::cms.layouts.master')


@section('content')
	<form method="POST" action="/admin/pages">
		{!! Form::token(); !!}
		{!! FormMaker::fromTable('pages', Config::get('apartment.forms.generic')) !!}
		
		<input type="submit" name="submit" value="Save" />
	</form>
@endsection
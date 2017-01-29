@extends('apartment-cms::cms.layouts.master')


@section('content')
	<form action="/admin/pages/{{$page->slug}}" method="POST">
		{!! Form::token(); !!}
		
		{!! FormMaker::fromObject($page, Config::get('apartment.forms.generic')) !!}
		
		<hr />	
		
		@if( $templateData )
			{!! FormMaker::fromObject($templateData, Config::get('apartment.forms.'.$model)) !!}
		@else
			{!! FormMaker::fromArray( Config::get('apartment.forms.'.$model) ) !!}
		@endif

		<input type="submit" name="submit" value="Save" />
	</form>
@endsection
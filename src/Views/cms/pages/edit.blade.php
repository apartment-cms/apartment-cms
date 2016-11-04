@extends('apartment-cms::cms.layouts.master')


@section('content')
	<form method="/admin/pages/{slug}" action="POST">
		<input type="text" name="name" id="name" value="{{ $page->name }}" />
		<input type="submit" name="submit" value="Save" />
	</form>
@endsection
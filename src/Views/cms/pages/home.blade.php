@extends('apartment-cms::cms.layouts.master')


@section('content')
	<h4>Pages</h4>
	<ul>
	@foreach( $pages->getAll()->sortBy('sort_order') as $page )
		<li><a href="/admin/pages/{{ $page->slug }}">{{ $page->name }}</a></li>
	@endforeach
	</ul>
@endsection
@extends('apartment-cms::cms.layouts.master')


@section('content')
	<ul>
	@foreach( $pages->all()->sortBy('sort_order') as $page )
		<li><a href="/admin/pages/{{ $page->slug }}">{{ $page->name }}</a></li>
	@endforeach
	</ul>
@endsection
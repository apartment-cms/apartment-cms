@extends('apartment-cms::layouts.master')

@section('content')

@if( isset( $item ) )
	
	<h1>{{ $item->name }}</h1>
	{!! $item->content !!}

@else

	<h1>{{ $page->name }}</h1>

	{!! $template->content !!}

	<ul>
	@foreach( $template->bucket->items as $item )

		<li>
			<a href="/{{ $page->slug }}/{{ $item->slug }}">{{ $item->name }}</a>
		</li>

	@endforeach
	</ul>

@endif

@endsection
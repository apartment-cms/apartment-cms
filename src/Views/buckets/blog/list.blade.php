@extends('apartment-cms::buckets.master-list')

@section('content')

<ul>
@foreach( $items as $item )
	<li><a href="/{{ $bucket->slug }}/{{ $item->slug }}">{{ $item->name }}</a></li>
@endforeach
</ul>
@endsection
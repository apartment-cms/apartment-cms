@extends('apartment-cms::buckets.master-single')

@section('content')

<h1>{{ $item->name }}</h1>

{!! $item->content !!}

@endsection
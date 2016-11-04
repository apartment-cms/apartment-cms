@extends('apartment-cms::layouts.master')

@section('content')
<p>Text Page</p>
<h1>{{ $page->name }}</h1>

{!! $template->content !!}
@endsection
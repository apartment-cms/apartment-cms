<!DOCTYPE html>
<html>
<head>
	<title>Apartment CMS</title>
</head>
<body>
<nav>
	@foreach( $page->navigation() as $item )
		<li><a href="/{{ $item->slug }}">{{ $item->name }}</a></li>
	@endforeach
</nav>
<h1>{{ $bucket->name }}</h1>
@yield('content')
</body>
</html>
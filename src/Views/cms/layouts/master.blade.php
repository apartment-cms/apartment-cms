<!DOCTYPE html>
<html>
<head>
	<title>Apartment CMS</title>
</head>
<body>
<header>
	<div class="brand">
		<p>Apartment CMS</p>
		<p>Admin Panel</p>
	</div>
	<div>
		<h1>{{ $pages->name }}</h1>
		<a href="/admin">Home</a>
		<a href="/admin/pages">New Page</a>
		<a href="/logout">Logout</a>
	</div>
</header>
<sidebar>
	<ul>
	@foreach( $buckets->all()->sortBy('sort_order') as $bucket )
		<li><a href="/admin/buckets/{{ $bucket->slug }}">{{ $bucket->name }}</a></li>
	@endforeach
	</ul>	
</sidebar>
<div class="main">
@yield('content')
</div>
</body>
</html>
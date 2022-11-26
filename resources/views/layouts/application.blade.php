<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title')</title>
		@vite(['resources/sass/app.scss', 'resources/js/app.js'])
	</head>
	<body>
		@include('shared.navbar')
		<div class="container mt-3">
			@include('shared.flash')
			@yield('content')
		</div>
	</body>
</html>

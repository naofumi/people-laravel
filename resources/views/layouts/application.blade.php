<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title')</title>
		@vite(['resources/sass/app.scss', 'resources/js/app.js'])

		<script type="module">
		  import hotwiredTurbo from 'https://cdn.skypack.dev/@hotwired/turbo';
		</script>
	</head>
	<body>
		@include('shared.navbar')
		<div class="container">
			@yield('content')
		</div>
	</body>
</html>

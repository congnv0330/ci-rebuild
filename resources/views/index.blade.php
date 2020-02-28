<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>
		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/index.blade.php</code>
		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>
	</div>
	<p class="footer">
		{!! (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' !!}
	</p>
	<script src="{{ mix('/js/app.js') }}"></script>
</div>
</body>
</html>

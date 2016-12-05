<html>
	<head>
	<title>Viktorina: Testiniai klausimai</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<h1>Palaukite</h1>
		<script type="text/javascript">
			var source = new EventSource('Admin/reset.php');
			source.onmessage = function(e) {
				document.location = "Client.php";
			};
		</script>
	</body>
</html>

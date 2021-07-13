<?php
	session_start();

	unset($_SESSION['usuario']);
	unset($_SESSION['senha']);
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Twitter clone</title>
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	</head>
	<body>
		<?php
			header("Location: index.php");
		?>
	</body>
</html>
<?php

	session_start();

	if(!isset($_SESSION['usuario'])){header("Location: index.php?erro=1");}

	require_once('bd.class.php');

	$id_usuario = $_SESSION['id_usuario'];
	$tweet = $_POST['txt_tweet'];

	$objBd = new bd();
	$link = $objBd->conecta_mysql();
	$objBd->query = "INSERT INTO tweet(ID_Usuário, Tweet)values('$id_usuario', '$tweet')";

	if(mysqli_query($link,$objBd->query)){
		echo "post gravado no banco de dados";
	}else{
		echo "erro ao gravar o post";
	}

?>
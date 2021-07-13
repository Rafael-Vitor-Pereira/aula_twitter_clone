<?php
	session_start();

	if(!isset($_SESSION['usuario'])){header("Location: index.php?erro=1");}

	require_once('bd.class.php');

	$id_usuario = $_SESSION['id_usuario'];
	$seguir_id_usuario = $_POST["seguir_id_usuario"];

	$objBd = new bd();
	$link = $objBd->conecta_mysql();
	$objBd->query = "INSERT INTO usuario_seguidores(ID_Usuário, seguindo_id_usuario)values('$id_usuario', '$seguir_id_usuario')";

	if(mysqli_query($link,$objBd->query)){
		echo "post gravado no banco de dados";
	}else{
		echo "erro ao gravar o post";
	}
?>
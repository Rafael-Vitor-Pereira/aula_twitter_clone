<?php
	session_start();

	if(!isset($_SESSION['usuario'])){header("Location: index.php?erro=1");}

	require_once('bd.class.php');

	$id_usuario = $_SESSION['id_usuario'];
	$seguir_id_usuario = $_POST["seguir_id_usuario"];

	$objBd = new bd();
	$link = $objBd->conecta_mysql();
	$objBd->query = "DELETE FROM usuario_seguidores WHERE ID_Usuário = $id_usuario AND seguindo_id_usuario = $seguir_id_usuario";

	if(mysqli_query($link,$objBd->query)){
		echo "post gravado no banco de dados";
	}else{
		echo "erro ao gravar o post";
	}
?>
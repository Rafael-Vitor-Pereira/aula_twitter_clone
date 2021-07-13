<?php
	session_start();

	require_once('bd.class.php');

	$usuario 	= $_POST['usuario'];
	$senha 		= md5($_POST['senha']);

	$objBd = new bd();
	$link = $objBd->conecta_mysql();
	$objBd->query = " SELECT ID, Usuário, Email, DATE_FORMAT(Data_Cadastro, '%d %b %Y') AS Data_Cadastro_formatada FROM usuario WHERE Usuário = '$usuario' AND Senha = '$senha' ";

	$result = mysqli_query($link,$objBd->query);

	if($result){

		$dados_usuario = mysqli_fetch_array($result);

		if(isset($dados_usuario['Usuário'])){

			$_SESSION["id_usuario"]		= $dados_usuario['ID'];
			$_SESSION["usuario"]		= $dados_usuario['Usuário'];
			$_SESSION["email"]			= $dados_usuario['Email'];
			$_SESSION["data_cadastro"] 	= $dados_usuario['Data_Cadastro_formatada'];

			header("Location: home.php");
			
		} else {
			header("Location: index.php?erro=1");
		}
	} else {
		echo 'Erro na execução da consulta, favor entrar em contato com o admin do site';
	}
?>
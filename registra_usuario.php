<?php
	require_once('bd.class.php');

	$usuario	= $_POST['usuario'];
	$email 		= $_POST['email'];
	$senha		= md5($_POST['senha']);

	$objBd = new bd();
	$link = $objBd->conecta_mysql();

	$usuario_existe = false;
	$email_existe = false;

	$objBd->query = "SELECT * from usuario where Usuário = '$usuario' ";

	if($result = mysqli_query($link,$objBd->query)){
		$dados = mysqli_fetch_array($result);
		if(isset($dados['Usuário'])){
			$usuario_existe = true;
		}
	}

	$objBd->query = "SELECT * from usuario where Email = '$email'";

	if($result = mysqli_query($link,$objBd->query)){
		$dados = mysqli_fetch_array($result);
		if(isset($dados['Email'])){
			$email_existe = true;
		}
	}

	if($usuario_existe || $email_existe){

		$retorno_get = '';

		if($usuario_existe){
			$retorno_get.= "erro_usuario=1&";
		}

		if($email_existe){
			$retorno_get.= "erro_email=1&";
		}

		header("Location: inscrevase.php?".$retorno_get);
		die();
	}

	$objBd->query = "INSERT into usuario(Usuário, Email, Senha)values('$usuario', '$email', '$senha') ";

	if(mysqli_query($link,$objBd->query)){
		echo 'Usuário foi registrado com sucesso!';
	} else {
		echo 'Erro ao tentar inserir o registro';
	}

?>
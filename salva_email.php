<?php
	session_start();

	if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

	$nome 			= $_SESSION['usuario'];
	$id_usuario 	= $_SESSION['id_usuario'];
	$email_antigo 	= $_POST["troca_email_1"];
	$novo_email 	= $_POST["troca_email_2"];
	$confirma 		= $_POST["troca_email_3"];

	require_once "bd.class.php";

	$objBd = new bd();
	$link = $objBd->conecta_mysql();

	$objBd->query = "SELECT Usuário, Email FROM usuario WHERE ID = $id_usuario";

	if($result = mysqli_query($link,$objBd->query)){
		$registro = mysqli_fetch_array($result);

		if (isset($registro["Usuário"])){
			$email = $registro["Email"];
			$usuario = $registro['Usuário'];

			if ($email_antigo == $email && $novo_email == $confirma) {
				$objBd->query = "UPDATE usuario SET Email = '$novo_email' WHERE Usuário = '$usuario' AND ID = $id_usuario";
				mysqli_query($link,$objBd->query);
				header("Location: minha_conta.php?"."id=1");
			}else{
				if ($email_antigo == $email && $novo_email != $confirma) {
					header("Location: minha_conta.php?"."error_email=1");
				}elseif ($email_antigo != $email && $novo_email == $confirma) {
					header("Location: minha_conta.php?"."error_email=2");
				}elseif ($email_antigo != $email && $novo_email != $confirma) {
					header("Location: minha_conta.php?"."error_email=3");
				}
			}
		}else{
			echo "Erro: Registro de Usuário não Encontrado";
		}
	}else{
		echo "Erro de Consulta";
	}
?>
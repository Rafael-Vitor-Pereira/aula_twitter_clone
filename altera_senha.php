<?php
	session_start();

	require_once "bd.class.php";

	$usuario 	= $_POST["usuario"];
	$email 		= $_POST["email"];
	$nova_senha = md5($_POST["nova_senha"]);
	$confirma 	= md5($_POST["confirma"]);

	$objBd = new bd();
	$link = $objBd->conecta_mysql();

	$objBd->query = "SELECT Usuário, Email FROM usuario WHERE Usuário = '$usuario' AND Email = '$email'";

	if($result = mysqli_query($link,$objBd->query)){
		$registro = mysqli_fetch_array($result);
		
		if (isset($registro["Usuário"])){
			$_SESSION["id_usuario"]		= $dados_usuario['ID'];
			$_SESSION["usuario"]		= $dados_usuario['Usuário'];
			$_SESSION["email"]			= $dados_usuario['Email'];
			$_SESSION["data_cadastro"] 	= $dados_usuario['Data_Cadastro_formatada'];

			if ($nova_senha == $confirma){
				$objBd->query = "UPDATE usuario SET Senha = '$nova_senha' WHERE Usuário = '$usuario' AND Email = '$email'";
				if($result = mysqli_query($link,$objBd->query)){
					session_start();
					header("Location: index.php?"."id=1");
				}else{
					header("Location: trocar_senha.php?"."error=1");
				}
			}
		}
	}
	Echo "Erro";
?>
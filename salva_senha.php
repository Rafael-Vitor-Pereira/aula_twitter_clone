<?php
	session_start();

	if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

	$nome 			= $_SESSION['usuario'];
	$id_usuario 	= $_SESSION['id_usuario'];
	$senha_antiga 	= md5($_POST["troca_senha_1"]);
	$nova_senha 	= md5($_POST["troca_senha_2"]);
	$confirma 		= md5($_POST["troca_senha_3"]);

	require_once "bd.class.php";

	$objBd = new bd();
	$link = $objBd->conecta_mysql();

	$objBd->query = "SELECT Usuário, Senha FROM usuario WHERE ID = $id_usuario";

	if($result = mysqli_query($link,$objBd->query)){
		$registro = mysqli_fetch_array($result);

		if (isset($registro["Usuário"])){
			$senha = $registro["Senha"];
			$usuario = $registro['Usuário'];

			if ($senha_antiga == $senha && $nova_senha == $confirma) {
				$objBd->query = "UPDATE usuario SET Senha = '$nova_senha' WHERE Usuário = '$usuario' AND ID = $id_usuario";
				mysqli_query($link,$objBd->query);
				header("Location: minha_conta.php?"."id=1");
			}else{
				if ($senha_antiga == $senha && $nova_senha != $confirma) {
					header("Location: minha_conta.php?"."error_senha=1");
				}elseif ($senha_antiga != $senha && $nova_senha == $confirma) {
					header("Location: minha_conta.php?"."error_senha=2");
				}elseif ($senha_antiga != $senha && $nova_senha != $confirma) {
					header("Location: minha_conta.php?"."error_senha=3");
				}
			}
		}else{
			echo "Erro: Registro de Usuário não Encontrado";
		}
	}
?>
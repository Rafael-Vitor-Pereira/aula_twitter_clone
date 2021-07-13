<?php
	session_start();

	if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

	$nome 		= $_SESSION['usuario'];
	$email 		= $_SESSION['email'];
	$erro_senha = isset($_GET["error_senha"]) ? $_GET["error_senha"] : 0;
	$erro_email = isset($_GET["error_email"]) ? $_GET["error_email"] : 0;
	$id 		= isset($_GET["id"]) ? $_GET["id"] : 0;

	require_once "bd.class.php";

	$objBd = new bd();
	$link = $objBd->conecta_mysql();

	$objBd->query = "SELECT * FROM usuario WHERE Usuário = '$nome'";

	if ($result = mysqli_query($link,$objBd->query)) {
		$registro = mysqli_fetch_array($result);

		if (isset($registro["Usuário"])) {
			$email = $registro["Email"];
		}
	}

	if ($erro_senha == 1){
		$error = "placeholder = 'Senha não Corresponde' style = 'border-color: red'";
	}elseif ($erro_senha == 2) {
		$error1 = "placeholder = 'Senha Incorreta' style = 'border-color: red'";
	}elseif ($erro_senha == 3) {
		$error2 = "placeholder = 'Senha Incorreta' style = 'border-color: red'";
		$error3 = "placeholder = 'Senha não Corresponde' style = 'border-color: red'";
	}

	if ($erro_email == 1){
		$error = "placeholder = 'Email não Corresponde' style = 'border-color: red'";
	}elseif ($erro_email == 2) {
		$error1 = "placeholder = 'Email Incorreta' style = 'border-color: red'";
	}elseif ($erro_email == 3) {
		$error2 = "placeholder = 'Email Incorreta' style = 'border-color: red;'";
		$error3 = "placeholder = 'Email não Corresponde' style = 'border-color: red'";
	}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Twitter clone</title>
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script type="text/javascript">
			$(document).ready(function(){
				$("#troca_senha").click(function(){
					$("#form_senha").show();
					$("#form_email").hide();
					$("#enviar_senha").click(function(){
						var camp_vazio = false;

						if($("#senha").val() == ""){
							$('#senha').css({'border-color': '#A94442'});
							alert("Preencha Todos os Campos");
							campo_vazio = true;
						}else {
							$('#senha').css({'border-color' : '#ccc'});
						}

						if($("#nova_senha").val() == ""){
							$('#nova_senha').css({'border-color': '#A94442'});
							alert("Preencha Todos os Campos");

							campo_vazio = true;
						}else {
							$('#nova_senha').css({'border-color' : '#ccc'});
						}

						if($("#confirma").val() == ""){
							$('#confirma').css({'border-color': '#A94442'});
							alert("Preencha Todos os Campos");
							campo_vazio = true;
						}else {
							$('#confirma').css({'border-color' : '#ccc'});
						}

						if(campo_vazio){
							return false;
							window.location.reload();
						}
					});
				});
				$("#troca_email").click(function(){
					$("#form_senha").hide();
					$("#form_email").show();
					$("#enviar_email").click(function(){
						var campo_vazio = false;

						if ($("#email").val() == "") {
							$("#email").css({'border-color': '#A94442'});
							alert("Preencha Todos os Campos");
							campo_vazio = true;
						}else{
							$("#email").css({'border-color': '#ccc'});
						}

						if ($("#novo_email").val() == "") {
							$("#novo_email").css({'border-color': '#A94442'});
							alert("Preencha Todos os Campos");
							campo_vazio = true;
						}else{
							$("#novo_email").css({'border-color': '#ccc'});
						}

						if ($("#confirma_email").val() == "") {
							$("#confirma_email").css({'border-color': '#A94442'});
							alert("Preencha Todos os Campos");
							campo_vazio = true;
						}else{
							$("#confirma_email").css({'border-color': '#ccc'});
						}

						if(campo_vazio){
							return false;
							window.location.reload();
						}
					});
				});
			});
		</script>
	</head>
	<body>
	    <nav class="navbar navbar-default navbar-static-top">
	    	<div class="container">
	        	<div class="navbar-header">
	        		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            		<span class="sr-only">Toggle navigation</span>
	            		<span class="icon-bar"></span>
	            		<span class="icon-bar"></span>
	            		<span class="icon-bar"></span>
	        		</button>
	        		<img src="imagens/icone_twitter.png" />
	        	</div>
	        	<div id="navbar" class="navbar-collapse collapse">
	        		<ul class="nav navbar-nav navbar-right">
	          			<li><a href="home.php">Home</a></li>
	            		<li><a href="sair.php">Sair</a></li>
	        		</ul>
	        	</div>
	    	</div>
	    </nav>
	    <div class="container">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
	    			<div class="panel-body">
	    				<h3><b>Informações Pessoais</b></h3>
	    				<hr>
	    				<h4>Usuário: <?=$_SESSION['usuario']?></h4>
	    				<h4>E-mail: <?= $email ?></h4>
	    				<h4>Entrou desde: <?=$_SESSION['data_cadastro']?></h4>
	    				<div class="col-md-10">
	    					<input type="button" class="btn btn-default pull-right" id="troca_senha" value="Trocar Senha">
	    				</div>
	    				<div class="col-md-1"></div>
	    				<div class="col-md-1">
	    					<input type="button" class="btn btn-default pull-right" id="troca_email" value="Trocar Email">
	    				</div>
			            <h5 style="color: red">
				    		<?php
				    			if ($erro_senha == 1){
				    				echo "Não foi Possível Alterar a senha <b>Tente Novamente</b>";
				    			}elseif ($erro_senha == 2){
				    				echo "Não foi Possível Alterar a senha <b>Tente Novamente</b>";
				    			}elseif ($erro_senha == 3){
				    				echo "Não foi Possível Alterar a senha <b>Tente Novamente</b>";
				    			}

				    			if ($erro_email == 1){
			    					echo "Não foi Possível Alterar o email <b>Tente Novamente</b>";
			    				}elseif ($erro_email == 2){
			    					echo "Não foi Possível Alterar a email <b>Tente Novamente</b>";
			    				}elseif ($erro_email == 3){
			    					echo "Não foi Possível Alterar a email <b>Tente Novamente</b>";
			    				}
				    		?>
			    		</h5>
			    		<h5 style="color: green">
				    		<?php
				    			if ($id == 1){
				    				echo "<b>Email ou Senha Alterado com Sucesso</b>";
				    			}
				    		?>
			    		</h5>
			    		<form class="form-control" style = "display: none;" method="post" action="salva_senha.php" id="form_senha">
			    		<br>
				    	<h3><b>Trocar Senha</b></h3>
				    	<label>Senha Antiga:</label>
			    		<input type="password" class="form-control" name="troca_senha_1" id="senha" 
			    			<?php 
				    			if($erro_senha==2){
				    				echo $error1;
			    				}elseif($erro_senha==3){
			    					echo $error2;
			    				}
			    			?>
			    		>
			    		<label>Nova Senha:</label>
			    		<input type="password" class="form-control" name="troca_senha_2" id="nova_senha"
			    			<?php 
			    				if($erro_senha==1){
			    					echo $error;
			    				}elseif($erro_senha==3){
			    					echo $error3;
				    			}
				    		?>
			    		>
			    		<label>Confirmar Senha:</label>
			    		<input type="password" class="form-control" name="troca_senha_3" id="confirma"
			    			<?php 
			    				if($erro_senha==1){
			    					echo $error;
			    				}elseif($erro_senha==3){
			    					echo $error3;
			    				} 
			    			?>
				    	>
				    	<br>
			    		<input type="submit" class="btn btn-primary pull-right" value="Salvar Senha" id="enviar_senha">
			    	</form>
			    	<form class="form-control" style="display: none;" method="post" action="salva_email.php" id="form_email">
			    	<br>
				    <h3><b>Trocar Email</b></h3>
				    <label>Email Antiga:</label>
			    	<input type="email" class="form-control" name="troca_email_1" id="email" 
			    		<?php 
				    		if($erro_email==2){
				    			echo $error1;
			    			}elseif($erro_email==3){
			    				echo $error2;
			    			}
			    		?>
			    	>
			    	<label>Novo Email:</label>
			    	<input type="email" class="form-control" name="troca_email_2" id="novo_email"
			    		<?php 
			    			if($erro_email==1){
			    				echo $error;
			    			}elseif($erro_email==3){
			    				echo $error3;
				    		}
				    	?>
			    	>
			    	<label>Confirmar Email:</label>
			    	<input type="email" class="form-control" name="troca_email_3" id="confirma_email"
			    		<?php 
			    			if($erro_email==1){
			    				echo $error;
			    			}elseif($erro_email==3){
			    				echo $error3;
			    			} 
			    		?>
				    >
				    <br>
			    	<input type="submit" class="btn btn-primary pull-right" value="Salvar Email" id="enviar_email">
			    </form>
			</div>
  		</div>
	   	<div class="col-md-2"></div>
		<div class="clearfix"></div>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
<?php
	session_start();

	if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

	require_once('bd.class.php');

	$objBd = new bd();
	$link = $objBd->conecta_mysql();

	$id_usuario = $_SESSION['id_usuario'];

	$objBd->query = "SELECT COUNT(*) AS qtd_tweets FROM tweet WHERE ID_Usuário = '$id_usuario'";

	$result 	= mysqli_query($link,$objBd->query);
	$qtd_tweet 	= mysqli_fetch_array($result);

	$objBd->query = "SELECT COUNT(*) AS qtd_seguidores FROM usuario_seguidores WHERE seguindo_id_usuario = '$id_usuario'";

	$result 		= mysqli_query($link,$objBd->query);
	$qtd_seguidores	= mysqli_fetch_array($result);

	$objBd->query = "SELECT COUNT(*) AS qtd_seguindo FROM usuario_seguidores WHERE ID_Usuário = '$id_usuario'";

	$result 		= mysqli_query($link,$objBd->query);
	$qtd_seguindo	= mysqli_fetch_array($result);
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Twitter clone</title>
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script type="text/javascript">
			$(document).ready( function(){
				$('#btn_tweet').click(function(){
					if($('#txt_tweet').val().length > 0){
						$.ajax({
							url: 'inclui_tweet.php',
							method: "post",
							data: $('#form_tweet').serialize(),
							success: function(data){
								$('#txt_tweet').val('');
								atualizaTweets();
							}
						});
					}
				});
				function atualizaTweets(){
					$.ajax({
						url: 'get_tweet.php',
						method: 'post',
						success: function(data){
							$('#tweets').html(data);
						}
					});
				}
				atualizaTweets();
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
	          			<li><a href="minha_conta.php">Minha Conta</a></li>
	            		<li><a href="sair.php">Sair</a></li>
	        		</ul>
	        	</div>
	    	</div>
	    </nav>
	    <div class="container">
	    	<div class="col-md-2">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<h4><?=$_SESSION['usuario']?></h4>
	    				<hr />
	    				<div class="col-md-12">
	    					<b>TWEETS</b> <br /> <?=$qtd_tweet["qtd_tweets"]?>
	    				</div>
	    				<br>
	    				<div class="col-md-12">
	    					<b>SEGUIDORES</b> <br /> <?=$qtd_seguidores["qtd_seguidores"]?>
	    				</div>
	    				<br>
	    				<div class="col-md-12">
	    					<b>SEGUINDO</b> <br /> <?=$qtd_seguindo["qtd_seguindo"]?>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="col-md-7">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<form id="form_tweet">
		    				<div class="input-group">
		    					<input type="text" class="form-control" id="txt_tweet" name="txt_tweet" placeholder="O que está acontecendo agora?" maxlength="140">
		    					<span class="input-group-btn">
		    						<button class="btn btn-default" id="btn_tweet" type="button">Tweet</button>
		    					</span>
		    				</div>
		    			</form>
	    			</div>
	    		</div>
	    		<div id="tweets" class="list-group"></div>	
	    	</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="procurar_pessoas.php">Procurar por pessoas</a></h4>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
	    </div>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>
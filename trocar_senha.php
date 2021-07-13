<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Twitter clone</title>
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script type="text/javascript">
			$(document).ready(function(){
				$('#salva_senha').click(function(){
					var campo_vazio = false;

					if ($("#usuario").val() == '') {
						alert("Favor Preencha o Nome de Usuário");
						$('#usuario').css({'border-color' : '#A94442'});
						campo_vazio = true;
					}else {
						$('#usuario').css({'border-color' : '#ccc'});
					}

					if ($("#email").val() == '') {
						alert("Favor Preencha o Email");
						$("#email").css({'border-color' : '#A94442'});
						campo_vazio = true;
					}else {
						$("#email").css({'border-color' : '#ccc'});
					}

					if ($("#nova_senha").val() == '') {
						alert("Favor Preencha a Nova Senha");
						$("#nova_senha").css({'border-color' : '#A94442'});
						campo_vazio = true;
					}else {
						$("#nova_senha").css({'border-color' : '#ccc'});
					}

					if (("#confirma").val() == '') {
						alert("Favor Confirme a Nova Senha");
						$("#confirma").css({'border-color' : '#A94442'});
						campo_vazio = true;
					}else {
						$("#confirma").css({'border-color' : '#ccc'});
					}

					if(campo_vazio){
						return false;
					}
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
	          			<li><a href="index.php">Voltar a Pagina Inicial</a></li>
	        		</ul>
	        	</div>
	    	</div>
	    </nav>
	    <div class="col-md-3"></div>
	    <div class="col-md-6">
	    	<form class = "form-control" method = "post" id = "form_senha" action="altera_senha.php">
	    		<br>
	    		<h3><b>Alterar Senha:</b></h3>
	    		<div class="form-group">
	    			<label>Usuário:</label>
					<input type="text" class="form-control red" id="usuario" name="usuario" placeholder="Nome de Usuário" />
				</div>
	    		<div class="form-group">
	    			<label>Email:</label>
					<input type="email" class="form-control red" id="email" name="email" placeholder="Email Cadastrado" />
				</div>
	    		<div class="form-group">
	    			<label>Nova Senha:</label>
					<input type="password" class="form-control red" id="nova_senha" name="nova_senha" placeholder="Nova Senha" />
				</div>
	    		<div class="form-group">
	    			<label>Confirmar Senha:</label>
					<input type="password" class="form-control red" id="confirma" name="confirma" placeholder="Confirmar Senha" />
				</div>
	    		<br>
	    		<input type="submit" class="btn btn-primary pull-right" id="salva_senha" value="Salvar Senha">
	    	</form>
	    </div>
	    <div class="col-md-3"></div>
	</body>
</html>
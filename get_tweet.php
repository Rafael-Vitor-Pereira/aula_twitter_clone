<?php
	session_start();

	if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

	require_once('bd.class.php');

	$id_usuario = $_SESSION['id_usuario'];

	$objBd = new bd();
	$link = $objBd->conecta_mysql();

	$objBd->query = " SELECT t.ID_tweet, t.ID_Usuário, t.Tweet, DATE_FORMAT(t.DATA_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, u.Usuário ";
	$objBd->query.= " FROM tweet AS t JOIN usuario AS u ON (t.ID_Usuário = u.ID) ";
	$objBd->query.= " WHERE ID_Usuário ='$id_usuario'";
	$objBd->query.= " OR ID_Usuário IN (SELECT seguindo_id_usuario FROM usuario_seguidores WHERE ID_Usuário = '$id_usuario')";
	$objBd->query.= " ORDER BY data_inclusao DESC ";

	$resultado_id = mysqli_query($link,$objBd->query);

	if($resultado_id){
		while($tweet = mysqli_fetch_array($resultado_id)){
			
			echo '<a href="#" class="list-group-item">';
			echo '<h4 class="list-group-item-heading">'.$tweet['Usuário'].' <small> - '.$tweet['data_inclusao_formatada'].'</small></h4>';
			echo '<p class="list-group-item-text">'.$tweet['Tweet'].'</p>';
			echo '</a>';
		}
	} else {
		echo 'Erro na execução da consulta.';
	}
?>
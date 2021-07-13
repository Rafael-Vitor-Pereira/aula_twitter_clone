<?php
	session_start();

	if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

	require_once('bd.class.php');

	$id_usuario = $_SESSION['id_usuario'];
	$nome = $_POST['txt_nome'];

	$objBd = new bd();
	$link = $objBd->conecta_mysql();
	$objBd->query = " SELECT u.*, us.ID_usuario_seguidor FROM usuario AS u ";
	$objBd->query.= " LEFT JOIN usuario_seguidores AS us ON (u.ID = us.seguindo_id_usuario AND us.ID_Usuário = $id_usuario) ";
	$objBd->query.= " WHERE u.Usuário like '%$nome%' AND u.ID <> $id_usuario ";

	$result = mysqli_query($link,$objBd->query);

	if($result){
		while($pessoa = mysqli_fetch_array($result)){
			$esta_seguindo_usuario_sn = isset($pessoa['ID_usuario_seguidor']) && !empty($pessoa['ID_usuario_seguidor']) ? 'S' : 'N';

			echo '<a href="#" class="list-group-item">';
				echo '<strong>'.$pessoa['Usuário'].'</strong> <small> - '.$pessoa['Email'].'</small>';
				echo '<p class="list-group-item-text pull-right">';

					$btn_seguir_display = 'block';
					$btn_deixar_seguir_display = 'block';

					if($esta_seguindo_usuario_sn == 'N') {
						$btn_deixar_seguir_display = 'none';
					} else {
						$btn_seguir_display = 'none';
					}

					echo '<button type="button" class="btn btn-default btn_seguir" id="seguir_'.$pessoa['ID'].'" data-id_usuario="'.$pessoa['ID'].'" style="display:'.$btn_seguir_display.'">Seguir</button>';
					echo '<button type="button" class="btn btn-primary btn_deixar_seguir" id="deixar_seguir_'.$pessoa['ID'].'" data-id_usuario="'.$pessoa['ID'].'" style="display:'.$btn_deixar_seguir_display.'">Deixar de seguir</button>';
				echo '</p>';
				echo '<div class="clearfix"></div>';
			echo '</a>';
		}

	} else {
		echo 'Erro na execução da consulta.';
	}
?>
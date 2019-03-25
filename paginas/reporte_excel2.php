
<?php
	session_start();
	require_once("conectar_DB.php");

	$fechaInicial = $_POST['fecha_inicial']. ' '.  $_POST['hora_inicial'];
	$fechaFinal = $_POST['fecha_final']. ' '.  $_POST['hora_final'];


	if ($_POST['maquina'] ==1){
		echo $fechaInicial. ' '. $fechaFinal. ' ';
	}

	?>

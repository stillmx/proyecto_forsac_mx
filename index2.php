<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, user-scalable=no"/>
	<title></title>
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
  <!-- <link rel="stylesheet" href="css/bootstrap-theme.css"> -->
	<link rel="stylesheet" href="css/menu.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<?php session_start();// Llamado de enlaces requeridos ?>
	<div id='contenedor'>
	<div id='encabezado'>
		<?php require ('includes/encabezado.php');?>
	</div>
	<div id='menu'>
		<?php require ('includes/menu.php');?>
	</div>
	<center>
	<div id='contenido'>
		<?php require ('includes/paginas.php');?>
	<br style='clear:both;'/>
	</div>
	</center>
	<div id='pie'>
		<?php require ('includes/pie.php');?>
	</div>
	</div>
</body>
</html>

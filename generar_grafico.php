<?php
session_start();
	require_once ("jpgraph/src/jpgraph.php");
	require_once ("jpgraph/src/jpgraph_pie.php");
	//require_once ("jpgraph/src/jpgraph_pie3d.php");

	// Se define el array de valores y el array de la leyenda
	$datos = array();
	$leyenda = array("Cortes (%1.1f%%)","Tubos OK (%1.1f%%)","Tubos Malos (%1.1f%%)");
	array_push($datos,$_SESSION["Tubera_Cortes"],$_SESSION["Tubera_TubosOK"],$_SESSION["Tubera_TubosMalos"]);

	//Se define el grafico
	$grafico = new PieGraph(1000,500,"auto");

	//Definimos el titulo
	$grafico->title->Set("");

	//Añadimos el titulo y la leyenda
	$pie_1 = new PiePlot($datos); //Crea el Gráfico
	$pie_1->SetLegends($leyenda);
	$pie_1->SetCenter(0.4);
	$pie_1->SetSize(160);
	$pie_1->ShowBorder($aFlg=false);
	$pie_1->value->SetColor("navy");

	//Se muestra el grafico
	$grafico->Add($pie_1);
	$grafico->Stroke();
?>

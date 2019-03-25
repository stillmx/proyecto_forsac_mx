<?php
session_start();
	require_once ("jpgraph/src/jpgraph.php");
	require_once ("jpgraph/src/jpgraph_pie.php");

	// Se define el array de valores y el array de la leyenda
	$datos = array();
	$leyenda = array("Baja C1 (%1.1f%%)","Baja C3 (%1.1f%%)","Alta C1 (%1.1f%%)","Alta C3 (%1.1f%%)");
	array_push($datos,$_SESSION["totalBajaC1"],$_SESSION["totalBajaC3"],$_SESSION["totalAltaC1"],$_SESSION["totalAltaC3"]);

	//Se define el grafico
	$grafico = new PieGraph(1000,500,"auto");

	//Definimos el titulo
	$grafico->title->Set("FLUJO INSTANSTANEO AIRE C");

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

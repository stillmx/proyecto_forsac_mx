<?php
session_start();
	require_once ("jpgraph/src/jpgraph.php");
	require_once ("jpgraph/src/jpgraph_pie.php");

	// Se define el array de valores y el array de la leyenda
	$datos = array();
	$leyenda = array("Cierra Premoldes B1 (%1.1f%%)","Op. Moldes B1 (%1.1f%%)","Op. Maquina B1 (%1.1f%%)","Aire Machos B1 (%1.1f%%)","Cierra Premoldes B2 (%1.1f%%)",
	"Op. Moldes B2 (%1.1f%%)","Op. Maquina B2 (%1.1f%%)","Aire Machos B2 (%1.1f%%)","Cierra Premoldes B3 (%1.1f%%)","Op. Moldes B3 (%1.1f%%)","Op. Maquina B3 (%1.1f%%)",
	"Aire Machos B3 (%1.1f%%)","Baja B1 (%1.1f%%)","Baja B2 (%1.1f%%)","Baja B3 (%1.1f%%)","Alta B1 (%1.1f%%)","Alta B2 (%1.1f%%)","Alta B3 (%1.1f%%)");
	array_push($datos,$_SESSION["total1"],$_SESSION["total3"],$_SESSION["total12"],$_SESSION["total10"],$_SESSION["total5"],$_SESSION["total2"],$_SESSION["total11"],$_SESSION["total7"],
$_SESSION["total4"],$_SESSION["total6"],$_SESSION["total8"],$_SESSION["total9"],$_SESSION["totalBajaB1"],$_SESSION["totalBajaB2"],$_SESSION["total18"],$_SESSION["totalAltaB1"],
$_SESSION["totalAltaB2"],$_SESSION["total17"]);

	//Se define el grafico
	$grafico = new PieGraph(1000,500,"auto");

	//Definimos el titulo
	$grafico->title->Set("FLUJO INSTANSTANEO AIRE B");

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

<?php // content="text/plain; charset=utf-8"
session_start();
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_bar.php');

// Some data
$datay=array();
array_push($datay,$_SESSION["Tubera_Cortes"],$_SESSION["Tubera_TubosOK"],$_SESSION["Tubera_TubosMalos"]);
// Create the graph and setup the basic parameters
$graph = new Graph(350,200,'auto');
$graph->clearTheme();
$graph->img->SetMargin(40,30,40,40);
$graph->SetScale("textint");
$graph->SetFrame(true,'blue',1);
$graph->SetColor('lightblue');
$graph->SetMarginColor('lightblue');

// Add some grace to the top so that the scale doesn't
// end exactly at the max value.
//$graph->yaxis->scale->SetGrace(20);

// Setup X-axis labels
//$a = $gDateLocale->GetShortMonth();
$leyenda = array("Cortes ","Tubos OK ","Tubos Malos");
$graph->xaxis->SetTickLabels($leyenda);
$graph->xaxis->SetFont(FF_FONT1);
$graph->xaxis->SetColor('navy','black');

// Stup "hidden" y-axis by given it the same color
// as the background
$graph->yaxis->SetColor('lightblue','navy');
$graph->ygrid->SetColor('white');

// Setup graph title ands fonts
// $graph->title->Set('Example of integer Y-scale');
// $graph->subtitle->Set('(With "hidden" y-axis)');
$graph->title->SetFont(FF_FONT2,FS_BOLD);
// $graph->xaxis->title->Set("Year 2002");
$graph->xaxis->title->SetFont(FF_FONT2,FS_BOLD);

// Create a bar pot
$bplot = new BarPlot($datay);
$bplot->SetFillColor('navy');
$bplot->SetColor('navy');
$bplot->SetWidth(0.5);
$bplot->SetShadow('darkgray');

// Setup the values that are displayed on top of each bar
$bplot->value->Show();
// Must use TTF fonts if we want text at an arbitrary angle
$bplot->value->SetFont(FF_ARIAL,FS_NORMAL,8);
$bplot->value->SetFormat('%d%%');
// Black color for positive values and darkred for negative values
$bplot->value->SetColor("navy");
$graph->Add($bplot);

// Finally stroke the graph
$graph->Stroke();
?>

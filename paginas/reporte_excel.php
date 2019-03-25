<?php
session_start();
require_once("conectar_DB.php");

$fechaInicial = $_POST['fecha_inicial']. ' '.  $_POST['hora_inicial'];
$fechaFinal = $_POST['fecha_final']. ' '.  $_POST['hora_final'];


if ($_POST['maquina'] ==1){
	$sql = "SELECT * FROM tubera WHERE Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal'";
	$query = $pdo->prepare($sql);
	$query->execute();
	if ($query->fetchColumn() > 0) {
		date_default_timezone_set('America/Lima');
		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');
			/** Se agrega la libreria PHPExcel */
			require_once '../PHPExcel/Classes/PHPExcel.php';
			// Se crea el objeto PHPExcel
			$objPHPExcel = new PHPExcel();
			// Se asignan las propiedades del libro
			$objPHPExcel->getProperties()->setCreator("") //Autor
				->setLastModifiedBy("") //Ultimo usuario que lo modificó
				->setTitle("Reporte Excel")
				->setSubject("Reporte Excel")
				->setDescription("")
				->setKeywords("")
				->setCategory("");
				$tituloReporte = "Reporte Máquina 1";
				$titulosColumnas = array("Fecha","Cortes","Tubos OK","Tubos Malos","Tipo de Parada","Operador","Técnico");
				// Se agrega la cantidad de celdas que ocupará tituloReporte
				// $objPHPExcel->setActiveSheetIndex(0)
				//     		    ->mergeCells('A1:I1');
				// Se agregan los titulos del reporte por columna
				$objPHPExcel->setActiveSheetIndex(0)
		 			->setCellValue('A1',  $tituloReporte)
		      ->setCellValue('A3',  $titulosColumnas[0])
	        ->setCellValue('B3',  $titulosColumnas[1])
     		  ->setCellValue('C3',  $titulosColumnas[2])
         	->setCellValue('D3',  $titulosColumnas[3])
					->setCellValue('E3',  $titulosColumnas[4])
					->setCellValue('F3',  $titulosColumnas[5])
	        ->setCellValue('G3',  $titulosColumnas[6]);
					//Se agregan los datos extraids de la DB
					$i = 4; //Comienza en la fila 4

					while ($fila = $query->fetch(PDO::FETCH_ASSOC)){
						$date = date_create($fila['Time_Stamp']);
						$formato_fecha = date_format($date, "d-m-Y H:i");
			 		  // $fila['referencia'];

							'Tubera_Cortes' => $fila['Tubera_Cortes'],
							'Tubera_TubosOK' => $fila['Tubera_TubosOK'],
							'Tubera_TubosMalos' => $fila['Tubera_TubosMalos'],
							'Tubera_TipoParada' => $fila['Tubera_TipoParada'],
							'Tubera_Operador' => $fila['Tubera_Operador'],
							'Tubera_Tecnico' => $fila['Tubera_Tecnico']



			 			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$i,  $formato_fecha)
     		    // ->setCellValue('B'.$i,  $fila['referencia'])
            ->setCellValue('B'.$i,  $fila['Tubera_Cortes'])
     		    ->setCellValue('C'.$i,  $fila['Tubera_TubosOK'])
       			->setCellValue('D'.$i,  $fila['Tubera_TubosMalos'])
	 					->setCellValue('E'.$i,  $fila['Tubera_TipoParada'])
	 					->setCellValue('F'.$i,  $fila['Tubera_Operador'])
	 		      ->setCellValue('G'.$i,  $fila['Tubera_Tecnico']);
	 					$i++;
					}

				


					//Estilo titulo Reporte
					$estiloTituloReporte = array(
				 		'font'   => array(
				 		'name'   => 'Arial',
				 		'bold'   => true,
				 		'italic' => false,
				 		'strike' => false,
				 		'size'   => 16,
				 		'color'  => array(
				 		'rgb'    => 'FFFFFF'
						)),
				 		'fill'  => array(
				 		'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				 		'color'	=> array(
						'rgb' 	=> 'FFfa82')//Color del fondo del titulo
				 		),
				 		'borders'    => array(
				 		'allborders' => array(
				 		'style' => PHPExcel_Style_Border::BORDER_NONE
				 		)),
				 		'alignment'  =>  array(
				 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				 		'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				 		'rotation'   => 0,
				 		'wrap'       => TRUE
				 	  ));
				    //Estilo titulo de las columnas
				    $estiloTituloColumnas = array(
				 		'font' 	=> array(
				 		'name'  => 'Arial',
				 		'bold'  => true,
				 		'color' => array(
				 		'rgb'   => 'FFFFFF'
				 		)),
				 		'fill'       => array(
				 	  'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				 		'rotation'   => 90,
				 		'startcolor' => array(
				 		'rgb'        => '4f8cbd'//'fa8236'
				 		)),
				 		'alignment'  =>  array(
				 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				 		'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				 		'wrap'       => TRUE
				 	  ));
				    //Estilo totales
			    	$estiloTituloTotales = array(
				 		'font'      => array(
				 		'name'      => 'Arial',
				 		'bold'      => true,
				 		'color'     => array(
				 	  'rgb'       => '000000'
				 		)),
				 		'fill' 	     => array(
				 	  'type'		   => PHPExcel_Style_Fill::FILL_SOLID,
				 	  'rotation'   => 90,
				 		'startcolor' => array(
				 		'rgb'        => '4f8cbd'//'b0fac0'
				 		)),
			    	'alignment'  =>  array(
				 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				 		'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				 		'wrap'       => TRUE
				 		));
				    //Estilo de los datos mostrados
			      $estiloInformacion = new PHPExcel_Style();
			      $estiloInformacion->applyFromArray(
			       array(
		   	 		'font'   => array(
				 		'name'   => 'Arial',
					 	'color'  => array(
					 	'rgb'    => '000000'
					 	)),
					 	'fill'   => array(
					 	'type'	 => PHPExcel_Style_Fill::FILL_SOLID,
					 	'color'	 => array('rgb' => 'b0fac0')
					  ),
					 	'alignment'  =>  array(
					 	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 	'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
					 	),
					 	'borders'     => array(
					 	'allborders'  => array(
					 	'style'    		=> PHPExcel_Style_Border::BORDER_THIN ,
					 	'color'  		  => array(
					 	'rgb'    		  => '414141'//'3a2a47'
					 	)
					 	)
					 	)
					 	));
						//Rango de estilo de titulo reporte
						//  $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($estiloTituloReporte);
						// Rango de estilo titulos de columnas
						$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);
						// Rango de estilo titulos de totales
						$objPHPExcel->getActiveSheet()->getStyle('A'.($i).':G'.($i))->applyFromArray($estiloTituloTotales);
						//Rango de estilos en los datos
						$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($i-1));
						//Rango de las columnas que aplica autoresize
						for($i = 'A'; $i <= 'Z'; $i++){
							$objPHPExcel->setActiveSheetIndex(0)
							->getColumnDimension($i)->setAutoSize(TRUE);
						}
					 	// Se asigna el nombre a la hoja
						$objPHPExcel->getActiveSheet()->setTitle('Reporte');
					 	// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
					 	$objPHPExcel->setActiveSheetIndex(0);
					 	// Inmovilizar paneles
					 	$objPHPExcel->getActiveSheet(0)->freezePane('A2');
				 		//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,20);
					 	// Se envía el archivo al navegador web, con el nombre que se indica (Excel2007)
						header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
						header("Content-Disposition: attachment; filename=reporte_".date('d-m-Y_H:i').".xls");
						header('Cache-Control: max-age=0');
					 	// Formato o versiòn de Excel a elegir: Excel5, Excel2007, otros.
					 	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
					 	$objWriter->save('php://output');
					 	exit;

		}
		// else{
		// echo"<script> alert('No hay datos para mostrar')
		// window.self.location='../';</script>";
		// }
}

?>

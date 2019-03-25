<?php
  // session_start();
  require("conectar_DB.php");
  error_reporting(E_ALL ^ E_NOTICE);
  $fechaInicial = $_POST['fecha_inicial']. ' '.  $_POST['hora_inicial'];
  $fechaFinal = $_POST['fecha_final']. ' '.  $_POST['hora_final'];

// COMPLETAR FILAS VACIAS DEL CAMPO DEL TECNICO
  $sql = "SELECT Tubera_TipoParada, Tubera_ContadorFalla FROM tubera WHERE Tubera_TipoParada =''";
  $query = $pdo->prepare($sql);
  $query->execute();
    if ($query->fetchColumn() =='' ) {
      $sql = "SELECT Tubera_TipoParada, Tubera_ContadorFalla FROM tubera WHERE Tubera_TipoParada <>''";
      $query = $pdo->prepare($sql);
      $query->execute();
      $fila = $query->fetchAll();
    // echo  $fila['Tubera_TipoParada'];
    foreach ($fila as $fila) {
      $fila['Tubera_ContadorFalla'];
      $sql = "UPDATE tubera SET Tubera_TipoParada =? WHERE Tubera_ContadorFalla=?";
      $query = $pdo->prepare($sql);
      $query->execute([$fila['Tubera_TipoParada'],$fila['Tubera_ContadorFalla']]);
    }
}

// COMPLETAR FILAS VACIAS DEL CAMPO DEL TECNICO

  if ($_POST['maquina'] ==1){
    $sql = "SELECT * FROM tubera WHERE Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal'";
    $query = $pdo->prepare($sql);
    $query->execute();
    if(!$query){
      echo"<script> alert('ERROR! No se pudo consultar la base de datos');</script>";
    }
    echo '<div class="reporte"><h4>Reporte por Máquina</h4> </div>';
    echo '<div><table class="compare">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col"><b> Fecha </b></th>';
    // echo '<th scope="col"><b> Referencia </b></th>';
    echo '<th scope="col"><b> Cortes </b></th>';
    echo '<th scope="col"><b> Tubos OK </b></th>';
    echo '<th scope="col"><b> Tubos Malos </b></th>';
    // echo '<th scope="col"><b> Velocidad Promedio </b></th>';
    echo '<th scope="col"><b> Tipo de Parada </b></th>';
    echo '<th scope="col"><b> Operador </b></th>';
    echo '<th scope="col"><b> Técnico </b></th>';
    echo '</tr>';
    echo '</thead>';
    echo '</div>';
    while ($fila = $query->fetch(PDO::FETCH_ASSOC)){
      echo '</tr>';
      echo '<tr>';
      echo '<td data-label="Fecha">';

      $date = date_create($fila['Time_Stamp']);
      // echo date_format($date, "d-m-Y H:i");
      echo date_format($date, "d-m-Y");
      echo '</td>';
      // echo '<td data-label="Referencia">';
      // echo $fila['referencia'];
      // // $total1+= $fila['referencia'];
      // echo '</td>';
      echo '<td data-label="Corte">';
      echo $fila['Tubera_Cortes'];
      $Tubera_Cortes+= $fila['Tubera_Cortes'];
      echo '</td>';
      echo '<td data-label="Prod. Buenos">';
      echo $fila['Tubera_TubosOK'];
      $Tubera_TubosOK+= $fila['Tubera_TubosOK'];
      echo '</td>';
      echo '<td data-label="Prod. Rechazados">';
      echo $fila['Tubera_TubosMalos'];
      $Tubera_TubosMalos+= $fila['Tubera_TubosMalos'];
      echo '</td>';
      echo '<td data-label="Tipo Parada">';
      echo $fila['Tubera_TipoParada'];
      // $total5+= $fila['Tubera_TipoParada'];
      echo '</td>';
      echo '<td data-label="Operador">';
      echo $fila['Tubera_Operador'];
      // $total2+= $fila['Tubera_Operador'];
      echo '</td>';
      echo '<td data-label="Tecnico">';
      echo $fila['Tubera_Tecnico'];
      // $total11+= $fila['Tubera_Tecnico'];
      echo '</td></tr>';

    }
    echo'</table>';


    $_SESSION["Tubera_Cortes"]= $Tubera_Cortes;
    $_SESSION["Tubera_TubosOK"]= $Tubera_TubosOK;
    $_SESSION["Tubera_TubosMalos"]= $Tubera_TubosMalos;
    if($Tubera_Cortes<>0) {
      echo '<center><img src="generar_grafico.php" width="100%"/></center>';
      echo '<center><img src="barintex2.php" width="50%"/></center>';
    }

  }

  // AQUI COMIENZA CONSULTA 2

  //REPORTE PROCESO TERMINADO
  if ($_POST['informe'] ==1){
    $sql = "SELECT Time_Stamp,Tubera_Cortes, Tubera_TubosMalos, Tubera_TubosOK, AVG(Tubera_Velocidad) AS veloc_prom, Tubera_TipoParada, COUNT(Tubera_ContadorFalla) AS tiempo, Tubera_ContadorFalla FROM tubera WHERE Tubera_ContadorFalla=0 AND Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY Tubera_ContadorFalla";
    $query = $pdo->prepare($sql);
    $query->execute();
    if(!$query){
      echo"<script> alert('ERROR! No se pudo consultar la base de datos');</script>";
    }
    echo '<div class="reporte"><h4>Reporte Proceso completado</h4> </div>';
    echo '<div><table class="compare">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col"><b> Fecha</b></th>';
    echo '<th scope="col"><b> Cortes </b></th>';
    echo '<th scope="col"><b> Tubos OK </b></th>';
    echo '<th scope="col"><b> Productos Rechazados </b></th>';
    echo '<th scope="col"><b> Veloc. Promedio </b></th>';
    echo '</tr>';
    echo '</thead>';
    echo '</div>';
    while ($fila = $query->fetch(PDO::FETCH_ASSOC)){
      echo '</tr>';
      echo '<tr>';
      echo '<td data-label="Fecha">';
      $date = date_create($fila['Time_Stamp']);
      // echo date_format($date, "d-m-Y H:i");
      echo date_format($date, "d-m-Y");
      echo '</td>';
      echo '</td>';
      echo '<td data-label="Corte">';
      echo $fila['Tubera_Cortes'];
      $Tubera_Cortes+= $fila['Tubera_Cortes'];
      echo '</td>';
      echo '<td data-label="Prod. Buenos">';
      echo $fila['Tubera_TubosOK'];
      $Tubera_TubosOK+= $fila['Tubera_TubosOK'];
      echo '</td>';
      echo '<td data-label="Prod. Rechazados">';
      echo $fila['Tubera_TubosMalos'];
      $Tubera_TubosMalos+= $fila['Tubera_TubosMalos'];
      echo '</td>';
      echo '<td data-label="Veloc. Promedio">';
      echo round($fila['veloc_prom'],2);
      $Tubera_TubosMalos+= $fila['veloc_prom'];
      echo '</td></tr>';
    }
    echo'</table>';
    //REPORTE POR PARADA
    if ($_POST['informe'] ==1){
      $sql = "SELECT Time_Stamp,Tubera_Cortes, Tubera_TubosMalos, Tubera_TubosOK, Tubera_TipoParada, COUNT(Tubera_ContadorFalla) AS tiempo, Tubera_ContadorFalla FROM tubera WHERE Tubera_ContadorFalla<>0 AND Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY Tubera_ContadorFalla";
      $query = $pdo->prepare($sql);
      $query->execute();
      if(!$query){
        echo"<script> alert('ERROR! No se pudo consultar la base de datos');</script>";
      }
      echo '<div class="reporte"><h4>Reporte por Paradas</h4> </div>';
      echo '<div><table class="compare">';
      echo '<thead>';
      echo '<tr>';
      echo '<th scope="col"><b> Fecha</b></th>';
      echo '<th scope="col"><b> Cortes </b></th>';
      echo '<th scope="col"><b> Tubos OK </b></th>';
      echo '<th scope="col"><b> Productos Rechazados </b></th>';
      echo '<th scope="col"><b> Tiempo de Parada </b></th>';
      echo '<th scope="col"><b> Tipo de Parada </b></th>';
      echo '</tr>';
      echo '</thead>';
      echo '</div>';
      while ($fila = $query->fetch(PDO::FETCH_ASSOC)){
        echo '</tr>';
        echo '<tr>';
        echo '<td data-label="Fecha">';
        $date = date_create($fila['Time_Stamp']);
        // echo date_format($date, "d-m-Y H:i");
        echo date_format($date, "d-m-Y");
        echo '</td>';
        echo '</td>';
        echo '<td data-label="Corte">';
        echo $fila['Tubera_Cortes'];
        $Tubera_Cortes+= $fila['Tubera_Cortes'];
        echo '</td>';
        echo '<td data-label="Prod. Buenos">';
        echo $fila['Tubera_TubosOK'];
        $Tubera_TubosOK+= $fila['Tubera_TubosOK'];
        echo '</td>';
        echo '<td data-label="Prod. Rechazados">';
        echo $fila['Tubera_TubosMalos'];
        $Tubera_TubosMalos+= $fila['Tubera_TubosMalos'];
        echo '</td>';
        echo '<td data-label="Tiempo Parada">';
        echo $fila['tiempo'];
        // $total5+= $fila['Tubera_TipoParada'];
        echo '<td data-label="Tipo Parada">';
        echo $fila['Tubera_TipoParada'];
        // $total5+= $fila['Tubera_TipoParada'];
        echo '</td></tr>';
      }
      echo'</table>';
    }

//REPORTE OEE
    if ($_POST['informe'] ==1){
      $sql = "SELECT Time_Stamp,Tubera_Cortes, Tubera_TubosMalos, Tubera_TubosOK, Tubera_TipoParada, COUNT(Tubera_ContadorFalla) AS tiempo FROM tubera WHERE Tubera_ContadorFalla=0 AND Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY Tubera_ContadorFalla";
      $query = $pdo->prepare($sql);
      $query->execute();
      if(!$query){
        echo"<script> alert('ERROR! No se pudo consultar la base de datos');</script>";
      }
      echo '<div class="reporte"><h4>Reporte Indicativo</h4> </div>';
      echo '<div><table class="compare">';
      echo '<thead>';
      echo '<tr>';
      echo '<th scope="col"><b> Fecha</b></th>';
      echo '<th scope="col"><b> Disponibilidad </b></th>';
      echo '<th scope="col"><b> Desempeño </b></th>';
      echo '<th scope="col"><b> Calidad </b></th>';
      echo '<th scope="col"><b> OEE </b></th>';
      echo '</tr>';
      echo '</thead>';
      echo '</div>';
      while ($fila = $query->fetch(PDO::FETCH_ASSOC)){
        // echo '</tr>';
        // echo '<tr>';
        // echo '<td data-label="Fecha">';
        $date = date_create($fila['Time_Stamp']);
        date_format($date, "d-m-Y");
        // echo '</td>';
        // echo '<td data-label="Tiempo Parada">';
        $fila['tiempo'];
        $tiempo_parada= $fila['tiempo'];
        // echo '</td>';
        // echo '<td data-label="Corte">';
        $fila['Tubera_Cortes'];
        $Tubera_Cortes= $fila['Tubera_Cortes'];
        // echo '</td>';
        // echo '<td data-label="Prod. Buenos">';
        $fila['Tubera_TubosOK'];
        $Tubera_TubosOK= $fila['Tubera_TubosOK'];
        // echo '</td>';
        // echo '<td data-label="Prod. Rechazados">';
        $fila['Tubera_TubosMalos'];
        $Tubera_TubosMalos= $fila['Tubera_TubosMalos'];
        echo '</td></tr>';
      }
      $t_minutos = (8*60);
      $disponibilidad = round((($t_minutos - (int)$tiempo_parada)/$t_minutos)*(100),2);
      $desempeño = round(($Tubera_TubosOK + $Tubera_TubosMalos)/($Tubera_Cortes)*(100),2);
      $calidad = round(($Tubera_TubosOK/$Tubera_Cortes)*(100),2);
      echo '<tr><td><b>'.date_format($date, "d-m-Y").'</b></td><td><b>'.$disponibilidad .
        ' %</b></td><td><b>'.$desempeño .' %</b></td>
        <td><b>'.$calidad .' %</b></td>
        <td><b>'.round(($disponibilidad * $desempeño * $calidad)/10000,2) .' %</b></td><tr>';
      echo'</table>';
    }
    $_SESSION["disponibilidad"]= $disponibilidad;
    $_SESSION["desempeño"]= $desempeño;
    $_SESSION["calidad"]= $calidad;
    if($Tubera_Cortes<>0) {
      echo '<center><img src="generar_grafico2.php" width="100%"/></center>';
    }

  }
?>

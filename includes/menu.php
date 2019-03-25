<!-- BOTONES -->
<div class="botones">
  <button id="boton1" type="button" name="button">Reporte por Máquina</button>
  <button id="boton2" type="button" name="button2">Reporte por Turno</button><span>Reporte por Máquina</span>
  <!-- <input type="text" name="desc" value="" id="desc"> -->
</div>
<!-- FIN BOTONES -->

<!--INICIO DE FORMULARIO  -->
 <form id="formulario" action="" method="post">
	 <table class="formulario">
		 <tr>
			 <td class="izquierda">Seleccione:</td>
			 <td>
				 <select name="maquina" required="required" width="150px">
					 <!-- <option disabled selected>Medidores</option> -->
					 <option value="1" selected>Máquina 1</option>
					 <option value="2">Máquina 2</option>
					 <option value="3">Máquina 3</option>
					 <option value="4">Máquina 4</option>
				 </select>
			 </td>
		 </tr>
		 <tr>
       <td class="izquierda">Fecha inicial:</td>
			 <td>
				 <input type="date" name="fecha_inicial" value="<?php echo date('Y-m-d'); ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
				 <input type="time" name="hora_inicial" value="00:00" required style="display:none;">
			 </td>
		 </tr>
		 <tr>
			 <td class="izquierda">Fecha final:</td>
			 <td>
				 <input type="date" name="fecha_final" value="<?php echo date('Y-m-d'); ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
				 <input type="time" name="hora_final" value="23:59" required style="display:none;">
			 </td>
		 </tr>
		 <tr>
			 <td>
         <!-- ¿Desea un reporte en Excel?
        <input type="checkbox" name="flag_excel" value="yes"> -->
        <input type="submit" name="submit" value="Descargar Excel" dir="paginas/reporte_excel.php">
      </td>
      <td>
        <input type="submit" name="submit" value="Mostrar" dir="index.php?pagina=consulta">
      </td>
    </tr>
  </table>

</form>
<!-- FIN FORMULARIO 1 -->

<!-- FORMULARIO 2 -->

<form id="formulario2" style="display: none;" action="" method="post">
  <table class="formulario">
    <tr>
      <td class="izquierda">Seleccione:</td>
      <td>
        <select name="informe" required="required" width="150px">
          <!-- <option disabled selected>Medidores</option> -->
          <option value="1" selected>Máquina 1</option>
          <option value="2">Máquina 2</option>
          <option value="3">Máquina 3</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="izquierda">Fecha inicial:</td>
      <td>
        <input type="date" name="fecha_inicial" value="<?php echo date('Y-m-d'); ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
        <input type="time" name="hora_inicial" value="00:00" required style="display:none;">
      </td>
    </tr>
    <tr>
      <td class="izquierda">Fecha final:</td>
      <td>
        <input type="date" name="fecha_final" value="<?php echo date('Y-m-d'); ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
        <input type="time" name="hora_final" value="23:59" required style="display:none;">
      </td>
    </tr>
    <tr>
      <td>
        <!-- ¿Desea un reporte en Excel?
       <input type="checkbox" name="flag_excel" value="yes"> -->
       <input type="submit" name="submit" value="Descargar Excel" id="" dir="">
       <!-- <input type="submit" name="submit" value="Descargar Excel" id="" dir="paginas/reporte_excel.php"> -->
     </td>
     <td>
       <input type="submit" name="submit" value="Mostrar" id="mostrar" dir="index.php?pagina=consulta">
     </td>
   </tr>
 </table>

</form>

<!-- FIN FORMULARIO 2 -->

<!-- JAVASCRIPT -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("input[type=submit]").click(function() {
  var accion = $(this).attr('dir');
  $('form').attr('action', accion);
  $('form').submit();

});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $("#boton1").click(function () {
    $("#formulario").show();
    $("span").html("Reporte por Máquina");
    $("#formulario2").hide();
    });
  $("#boton2").click(function () {
    $("#formulario").hide();
    $("#formulario2").show();
    $("span").html("Reporte por Turno");
    });
   });

</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyecto_Modultech</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <!--Inicio NAV  -->
<div class="container-fluid" style="background-color: #2e302e;">
  <div class="row">
    <div class="col xs-12">
      <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2e302e;">
      <a class="navbar-brand" <a href="./">
        <img src="images/1forsac.jpg" class="rounded" style="width:50px; height:50px;">
      </a>
      </nav>
    </div>
  </div>
</div>
<!--Fin NAV  -->
<div class="container-fluid md-5">
  <div class="row">
    <div class="col xs-12">
      <div class="ml-md-4 p-2" id="navbar">
        <form class="form-block col-lg-auto d-inline-flex">
          <button id="boton1" class="btn btn-outline-primary mr-2" type="button">Reporte por Máquina </button>
          <button id="boton2" class="btn btn-outline-success" type="button">Reporte por Turno</button>
        </form>
      </div>
    </div>
    </div>
      <div class="row ml-2 p-2" id="form1" style="display:none;">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-primary p-1 text-center text-light">
               Reporte por Máquina
            </div>
            <div class="card-body">
              <!-- FORM -->
              <form id="formulario1">
                <div class="form-group">
                  <label for="informe">Seleccione: </label>
                    <select id="informe" class="form-control" required="required">
                    <!-- <option disabled selected>Seleccione</option> -->
                    <option value="1">Máquina 1</option>
                    <option value="2">Máquina 2</option>
                    <option value="3">Máquina 3</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="fecha_inicial">Fecha Inicial: </label>
                  <input class="form-control" type="date" id="fecha_inicial" value="<?php echo date('Y-m-d'); ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                  <input type="time" name="hora_inicial" value="00:00" required style="display:none;">
                </div>
                <div class="form-group">
                  <label for="fecha_final">Fecha Final:</label>
                  <input class="form-control" type="date" id="fecha_final" value="<?php echo date('Y-m-d'); ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                  <input type="time" name="hora_final" value="23:59" required style="display:none;">
                </div>
                <input type="hidden" id="taskId">
                <button type="submit" class="btn btn-success text-center">
                  Descargar
                </button>
                <button type="submit" class="btn btn-primary text-center">
                  Mostrar
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row ml-2 p-2" id="form2" style="display: none;">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-success p-1 text-center text-light">
               Reporte por Turno
            </div>
            <div class="card-body">
              <!-- FORM TO ADD TASKS -->
              <form id="formulario2">
                <div class="form-group">
                  <label for="informe">Seleccione: </label>
                    <select id="informe" name="maquina" class="form-control" required="required">
                    <!-- <option disabled selected>Seleccione</option> -->
                    <option value="1">Máquina 1</option>
                    <option value="2">Máquina 2</option>
                    <option value="3">Máquina 3</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="fecha_inicial">Fecha Inicial: </label>
                  <input class="form-control" name="fecha_inicial" type="date" id="fecha_inicial" value="<?php echo date('Y-m-d'); ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                  <input type="time" name="hora_inicial" value="00:00" required style="display:none;">
                </div>
                <div class="form-group">
                  <label for="fecha_final">Fecha Final:</label>
                  <input class="form-control" name="fecha_final" type="date" id="fecha_final" value="<?php echo date('Y-m-d'); ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                  <input type="time" name="hora_final" value="23:59" required style="display:none;">
                </div>

                <input type="hidden" id="taskId">
                <button id="b_descargar" type="submit" class="btn btn-success text-center">
                  Descargar
                </button>
                <button id="b_mostrar" type="submit" class="btn btn-primary text-center">
                  Mostrar
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
      <!-- TABLA -->
    <div class="container-fluid my-md-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-12">
                <table class="table table-bordered ">
                  <thead>
                    <tr>
                      <td>Fecha</td>
                      <td>Cortes</td>
                      <td>Tubos Ok</td>
                      <td>Tubos Malos</td>
                      <!-- <td>Velocidad Promedio</td> -->
                      <td>Tipo de Parada</td>
                      <td>Operador</td>
                      <td>Técnico</td>
                    </tr>
                  </thead>
                  <tbody id="tabla">

                  </tbody>
                </table>
            </div>
        </div>
    </div>




<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/animated.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


$(document).ready(function(){
  $("#boton1").click(function () {
    $("#form1").fadeToggle(1000);
    $("#form2").hide();
    });
  $("#boton2").click(function() {
    $("#form1").hide();
    $("#form2").fadeToggle(1000);
    });

    $("input[type=submit]").click(function() {
      var accion = $(this).attr('dir');
      $('form').attr('action', accion);
      $('form').submit();

    });

    $("#formulario2").submit(function(e){
      e.preventDefault();
      $("#form2").fadeOut(500);

      $.ajax({
         type: "post",
         dataType: "json",
         url: $('form').attr('action'),
         data: $("#formulario2").serialize(),
         success: function(data){
           // let datos = data;
           // console.log(data);

           let template ="";
           $.each(data, function(i,e) {
             template += `
             <tr>
                <td>${e.Fecha}</td>
                <td>${e.Tubera_Cortes}</td>
                <td>${e.Tubera_TubosOK}</td>
                <td>${e.Tubera_TubosMalos}</td>
                <td>${e.Tubera_TipoParada}</td>
                <td>${e.Tubera_Operador}</td>
                <td>${e.Tubera_Tecnico}</td>
             </tr>
             `
              $("#tabla").html(template);
           });
         }
       });
  });





    $("#formulario2").submit(function(e){
      e.preventDefault();

      $.ajax({
        url:  "paginas/reporte_excel.php",
        type: "post",
        dataType: "json",
        data: $("#formulario2").serialize(),
        success: function(data){
          // let datos = data;
          // console.log(data);
        }
      });
    });

});

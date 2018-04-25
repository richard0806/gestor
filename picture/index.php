<!DOCTYPE HTML>
<html>
 <head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
     <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
   <script>
     $(function(){
       $("#file").on("change", function(){
           /* Limpiar vista previa */
           $("#vista-previa").html('');
           var archivos = document.getElementById('file').files;
           var navegador = window.URL || window.webkitURL;
           /* Recorrer los archivos */
           for(x=0; x<archivos.length; x++)
           {
               /* Validar tamaño y tipo de archivo */
               var size = archivos[x].size;
               var type = archivos[x].type;
               var name = archivos[x].name;
               if (size > 2048*2048)
               {
                   $("#vista-previa").append("<p style='color: red'>El archivo "+name+" supera el máximo permitido 2MB</p>");
               }
               else if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png' && type != 'image/gif')
               {
                   $("#vista-previa").append("<p style='color: red'>El archivo "+name+" no es del tipo de imagen permitida.</p>");
               }
               else
               {
                 var objeto_url = navegador.createObjectURL(archivos[x]);
                 $("#vista-previa").append("<img src="+objeto_url+" width='250' height='250' style='margin-right:10px;box-shadow: 0 16px 26px -10px rgba(84, 85, 88, 0.79), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(244, 67, 54, 0.2);'>");
               }
           }
       });

       $("#btn").on("click", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "multiple_ajax.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                    $("#formulario")[0].reset();
                    setTimeout(function(){
                      window.location.href = "../picture";
                    },800);
                }
            });
           });

     });
    </script>
 </head>
 <body>
   <div class="container">
 <form method="post" id="formulario" enctype="multipart/form-data" class="form-inline">
   <fieldset style="border: 1px solid #333; width:80%; padding:10px;">
     <legend style="width:25%; padding:12px">Datos Generales:</legend>
     <div class="form-row">
       <div class="form-group col-md-5">
          <label>ID Producto: </label>
          <input type="text" id="id_prod" name="id_prod" required="" autocomplete="off" autofocus="on" class="form-control form-control-sm">
        </div>
        <div class="form-group col-md-5">
          <label>  Subir imagen: </label>
          <input type="file" id="file" name="file[]" multiple>
        </div>
      </div>
      <button type="button" id="btn" class="btn btn-outline-primary btn-sm pull-right">Subir imágenes</button>
    </fieldset>
 </form><br>
  <div id="vista-previa"></div>
  <hr>
  <div id="respuesta"></div>
  </div>
 </body>
</html>

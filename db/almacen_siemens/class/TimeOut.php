<?php
if ($_SESSION["autentificado"] != "SI") {
    //si no está logueado lo envío a la página de autentificación
     header('Location: http://'.$_SERVER["SERVER_NAME"].':8080/almacen_siemens/index.php?error=2');
}else {
    //sino, calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	$calculo = 3 * 60; //minutos X segundos.
	
    //comparamos el tiempo transcurrido
     if($tiempo_transcurrido >= $calculo) {
		//si pasaron 10 minutos o más  alert("La session ha expirado, vuelva a iniciar Session. Gracias!");    
       echo'<script>
			 
			  window.location.href = "log_out.php";
			</script>
		 ';
     //sino, actualizo la fecha de la sesión
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }
} 
?>
<script>
   	setTimeout(function(){
   window.location.reload(1);
	}, 180000);
</script>
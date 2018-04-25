<?php
// Evitar los warnings the variables no definidas!!!
$err = isset($_GET['error']) ? $_GET['error'] : null ;

?>
<!DOCTYPE html>

<html lang="esp">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="RMSoluciones">
    <link rel="icon" href="cssalmacen/img/carrito.png">
    <title>Gestor de Mantenimiento Siemens</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap-3.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../font-awesome-4.3.0/css/font-awesome.min.css">
    
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="../bootstrap-3.3.1/docs/examples/cover/cover2.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap-3.3.1/docs/examples/signin/signin.css">
    <script type="text/javascript" src="jsalmacen/ie-emulation-modes-warning.js"></script>
	<link rel="stylesheet" type="text/css" href="cssalmacen/notice.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    div.alert{
		text-shadow:none;
		width: 100%;
	}
	 .modal-static { 
    position: fixed;
    top: 50% !important; 
    left: 50% !important; 
    margin-top: -100px;  
    margin-left: -100px; 
    overflow: visible !important;
}
.modal-static,
.modal-static .modal-dialog,
.modal-static .modal-content {
    width: 200px; 
    height: 200px; 
}
.modal-static .modal-dialog,
.modal-static .modal-content {
    padding: 0 !important; 
    margin: 0 !important;
}
.modal-static .modal-content .icon {
}
.alert{
    width: 300px;
    top: -75px;
    left: 0;
    color: #fff;
}
.alert-danger{
    background: rgb(228, 105, 105);
}
.alert-warning{
	background: #FFD900;
}
.alert-success{
    background: rgb(25, 204, 25);
}
.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInUp {
  0% {
    opacity: 0;
    -webkit-transform: translateY(20px);
    transform: translateY(20px);
  }

  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
  }
}

@keyframes fadeInUp {
  0% {
    opacity: 0;
    -webkit-transform: translateY(20px);
    -ms-transform: translateY(20px);
    transform: translateY(20px);
  }

  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
  }
}

.fadeInUp {
  -webkit-animation-name: fadeInUp;
  animation-name: fadeInUp;
}
.password .glyphicon-eye-open,#password2 .glyphicon-eye-open {
    display:none;
	color: #000;
    right: 15px;
    position: absolute;
    top: 10px;
    cursor:pointer;
	z-index: 2;
}

 </style> 
</head>
<body>
	<div class="site-wrapper">
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="masthead clearfix">
        <div class="inner">
          <h1 class="masthead-brand"><strong>Siemens</strong></h1>
        </div>
      </div>
      

      <div class="inner cover">
      <div style="padding: 20px;" id="form-olvidado">
      <input type="text" name="error" class="hidden" value="<?php echo $err; ?>">
        <form name="user" action="session_init.php" method="post" class="form-signin" id="formlogin">
        	<h2 class="form-signin-heading">Iniciar de Sesión</h2>
            <div id="output"></div>
        	  <div class="input-group">
                 <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                 <input type="text" name="usern" id="usern"  class="form-control" placeholder="Username o Email" required autofocus />
              </div>
              <div class="input-group password">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>            
          <input type="password" name="passwd" id="passwd" maxlength="20" class="form-control pwd" autocomplete="off" required placeholder="ej. X8df!90EO"/><span id="8char" class="glyphicon glyphicon-remove hidden" style="color:#FF0004;"></span>
            <span class="glyphicon glyphicon-eye-open"></span>      
        </div>
        		 <div class="help-block">
                    <a class="pull-right text-muted" href="#" id="olvidado" style="color:#5A5050;"><small>¿Olvidaste tu Contraseña?</small></a>
                  </div> 
                  <br>            
            	<button type="submit" name="enter" id="enter" class="btn main-btn btn-labeled btn-default btn-block" data-toggle="modal" data-target="#processing-modal"><span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span> Sign in</button>
                
        </form>
        </div>
        <div style="display: none;" id="form-olvidado">
    <h4 class="form-signin-heading">
      ¿Olvidaste tu Contraseña?
    </h4>
    <form accept-charset="UTF-8" role="form" id="frmRestablecer" action="pass/validaremail.php" method="post">
      <fieldset>
        <span class="help-block" style="color:#FFF;">
          Dirección de correo electrónico que utiliza para acceder a su cuenta         	
        </span>
        <div class="form-group input-group">
          <span class="input-group-addon">
            @
          </span>
          <input class="form-control" placeholder="Email" name="email" type="email" required id="email">
        </div>
        <button type="submit" class="btn btn-primary btn-block" id="btn-olvidado">
          Recuperar contraseña
        </button>
        <p class="help-block">
          <a class="text-muted" href="#" id="acceso" style="color:#5A5050;"><small>Acceder a la cuenta</small></a>
        </p>
      </fieldset>
      
    </form>
    
    <div id="mensaje" style="text-shadow:none;color:#333;"></div>
    
    
        
  </div>
  
  
          <div align="center">
            <h1><strong> Bienvenidos</strong></h1>
            <h2>Gestor de Mantenimiento</h2>
          </div>
      </div>
      
      <div class="mastfoot">
        <div class="inner">
          <p>Copyright © 2014-<?php echo date ("Y") ;?> Siemens RD. Todos los Derechos Reservados</p> <p>Design Web ~ <a href="../RM%20soluciones/index.php">RM Soluciones</a></p>
          <a href="http://www.facebook.com/RMsoluciones08"><i id="social" class="fa fa-facebook-square fa-3x social-fb"></i></a>
	            <a href="https://twitter.com/richard08081991"><i id="social" class="fa fa-twitter-square fa-3x social-tw"></i></a>
	            <a href="https://plus.google.com"><i id="social" class="fa fa-google-plus-square fa-3x social-gp"></i></a>
	            <a href="mailto:siemensalmacen@gmail.com"><i id="social" class="fa fa-envelope-square fa-3x social-em"></i></a>
        </div>         
      </div>
    </div>
    
    <!--/Modal loading...-->
    <div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <img src="http://www.travislayne.com/images/loading.gif" class="icon">
                        <h4 style="color:#000;">Processing... <button type="button" class="close" style="float: none;" data-dismiss="modal" aria-hidden="true">×</button></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--/Final del modal-->
    
</div>
</div>

	<script src="jsalmacen/jquery-2.1.3.min.js"></script>
    <script src="../bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(".pwd").on("keyup",function(){
		if($(this).val())
			$(".glyphicon-eye-open").show();
		else
			$(".glyphicon-eye-open").hide();
		});
			$(".glyphicon-eye-open").mousedown(function(){
                $(".pwd").attr('type','text');
            }).mouseup(function(){
            	$(".pwd").attr('type','password');
            }).mouseout(function(){
            	$(".pwd").attr('type','password');
            });
	var textfield = $("input[name=error]");
	 if (textfield.val() == 1) {
         //$("body").scrollTo("#output");
         $("#output").addClass("alert alert-danger animated fadeInUp").html("Usuario o Contraseña Erróneos");
         $("#output").removeClass(' alert-warning');
	 }
	 if (textfield.val() == 2) {
		 //remove success mesage replaced with error message
         $("#output").removeClass("alert alert-danger");
         $("#output").addClass("alert alert-warning animated fadeInUp").html("Debe <strong>Iniciar Seccion</strong> para poder acceder al Gestor ");
	 }
</script>
<script>	 
	 $(document).ready(function() {
		 $("#frmRestablecer").submit(function(event){
          event.preventDefault();
          $.ajax({
            url:'pass/validaremail.php',
            type:'post',
            dataType:'json',
            data:$("#frmRestablecer").serializeArray()
          }).done(function(respuesta){
            $("#mensaje").html(respuesta.mensaje);
            $("#email").val('');
          });
        });
		 
		  $('#olvidado').click(function(e) {
			e.preventDefault();
			$('div#form-olvidado').toggle('500');
			$('#email').focus();
		  });
		  $('#acceso').click(function(e) {
			e.preventDefault();
			$('div#form-olvidado').toggle('500');
			$('#usern').focus();
		  });
		
	});
	
	$(function(){
		$('#enter').prop('disabled', true);
		var a = 'no';
		 
		  $('#formlogin input').on("keyup",function(){
			  if($('#passwd').val().length > 0 && $('#usern').val().length > 0){				
				$("#8char").removeClass("glyphicon-remove");
				$("#8char").addClass("glyphicon-ok");
				$("#8char").css("color","#00A41E");
				a = 'si';
			}else{
				$("#8char").removeClass("glyphicon-ok");
				$("#8char").addClass("glyphicon-remove");
				$("#8char").css("color","#FF0004");
				a = 'no';
			}
			if(a == 'si'){
				$("#enter").prop( "disabled", false );
				//alert(a+'-'+s+'-'+d+'-'+f+'-'+g);
		 	 }else{
				$("#enter").prop('disabled', true);
			 }
		  });
		  //$("#enter").prop('disabled', true);
	});
	

	
</script>

</body></html>

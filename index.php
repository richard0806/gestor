<?php require 'global/visitas.php' ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale= 1,user-scalable=no">
 	<link rel="icon" href="css/image/icon.png">
	<title>Buscador | Gestor Mant.</title>
	<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="css/ihover/src/ihover.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css/main.css">

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top topbar">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">
					<span class="visible-xs"><img src="css/image/carrito.png" class="logo" alt=""></span>
					<span class="hidden-xs"><img src="css/image/carrito.png" class="logo" alt=""></span>
				</a>

				<p class="navbar-text">
					<a href="#" class="sidebar-toggle">
                        <i class="fa fa-bars fa-lg"></i>
                    </a>
                    <label for="" class="pull-right mclass">
                    	<a href="signin.php" class=""><i class="fa fa-user-o fa-lg" aria-hidden="true"></i></a>
                    	<a href="#" class="btn-search"><i class="fa fa-search fa-lg" aria-hidden="true"></i></a>
                	</label>
				</p>

			</div>

			<div class="navbar-collapse collapse" id="navbar-collapse-main">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="signin.php" class="">Sign in <i class="fa fa-user-o fa-lg" aria-hidden="true"></i></a></li>
					<li></li>
					<li><a href="#" class="btn-search"><i class="fa fa-search fa-lg" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="form-search">
		<div class="container">
			<form action="" method="post" class="form-inline" id="form-search" onsubmit="return validacion()">
				<h3>Busqueda</h3>
				<div class="form-group">
						<select name="txtAT" id="txtAT" class="form-control">
							<option value="all">ALL</option>
							<option value="1">CAT</option>
							<option value="2">SEN</option>
							<option value="3">ELE</option>
						</select>
						<input type="text" class="form-control" id="txtvalor">
						<a id="StockExcel" data-modal="#modal3" class="modal__trigger"><img src="css/image/reportExcel.png"></a>
				</div>
			</form>
		</div>
	</div>

	<article class="wrapper">
	    <!-- <aside class="sidebar">
	        <ul class="sidebar-nav">
	        	<li class="close-toggle">
	        		<a href="#" class="sidebar-toggle"><span><i class="fa fa-times fa-2x" aria-hidden="true"></i></span>
	                        </a>
	                    </li>
	    			    <li><a href="#dashboard" data-toggle="tab" class="hvr-bounce-to-left"><span> HOME</span></a></li>
	    		    </ul>
	    </aside> -->
		<div class="loading" style="display:none;">
			<div class="load">
				<img src="css/image/load.gif" alt="cargando">
				<h3>Cargando</h3>
				<h5>Espero un minuto, estamos procesando la informacion</h5>
			</div>
		</div>
	</article>

	<div class="container container1" style="margin-top:130px; max-width: 1300px;">
			<table class="table table-bordered table-condensed table-hover table-responsive scroll table-fixed" id="myTablequery">
				<thead bgcolor="#CCCCCC" style="font-size:12;font-family:Arial, Helvetica, sans-serif">
				<tr style="font-size:12px;">
		        	<th style="width: 36px;">#</th>
		            <th style="width: 357px;">Designacion</th>
		            <th style="width: 99px;">Palabra Clave</th>
		            <th style="width: 121px;">Referencia</th>
		            <th style="width: 128px;">SAP</th>
		            <th style="width: 64px;">ID</th>
		            <th style="width: 119px;">Ubicación</th>
		            <th style="width: 93px;">Stock Mant.</th>
		            <th style="width: 111px;">Stock Sob.-Mant.</th>
		            <th style="width: 109px;">Herramientas</th>
		        </tr>
	        	</thead>
	        	<tbody style="font-size:12px;">

	        	</tbody>
        	</table>
        	<div class="nota-informativa"></div>
		</div>
<!--// MODALS  //-->
		<div class="modal fade" id="myModalimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
		<!-- Modal -->
		<div id="edit" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">×</button>
		        <h4 class="modal-title"><i class="fa fa-edit fa-1x"></i> Modificar</h4>
		      </div>
		      <div class="modal-body">
		      	<form action="" id="keyword" class="form-horizontal">
		        	<div class="form-group">
		        		<label for="" class="col-sm-1 control-label" style="margin-bottom: 0px; padding-bottom: 1px;"> ID</label><br>
		        		<div class="col-sm-12">
		        			<input type="text" name="txtID" readonly="" class="form-control input-sm">
		        		</div>
					</div>
					<div class="form-group">
		        		<label for="" class="col-sm-6 control-label" style="margin-bottom: 0px; padding-bottom: 1px;"> Palabra Clave</label><br>
		        		<div class="col-sm-12">
		        			<input type="text" name="txtkeyword" placeholder="Introduzca la Palabra aqui" class="form-control input-sm" autofocus="">
		        		</div>
		        	</div>
		        	<br><br>
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        	<button type="submit" class="btn btn-danger">Modificar</button>

		        </form>
		      </div>

		      <div id="loading-02" style="display: none; text-align: center;">

		      </div>
		    </div>

		  </div>
		</div>

	<nav class="social hidden">
          <ul>
              <li><a href="#">Solicitar <i class="fa fa-share"></i></a></li>
          </ul>
      </nav>
		<?php require 'global/load.php'; ?>
	<!--MODALS-->
	<div id="modal3" class="modal modal3 modal__bg" role="dialog" aria-hidden="true">
		<div class="modal__dialog">
			<div class="modal__content">
				<h1>Stock Actual X AT</h1>
				<form class="form-inline" method="post" action="report/exportExcel.php" id="formReport">
				  <div class="form-group" id="divreport">
				    <label for="at">AT requerida</label><br>
				    	<select class="form-control" name="reportAt" id="at" style="width: 100%">
					    	<option value="">Seleccionar</option>
					    	<option value="1">CAT</option>
								<option value="2">SEN</option>
								<option value="3">ELE</option>
								<option value="4">ALL</option>
					    </select>
				  </div>
				  <button type="button" id='enviarReporte' class="btn btn-default">Descargar</button>
				</form>

				<!-- modal close button -->
				<a href="" class="modal__close demo-close">
					<svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
				</a>
			</div>
		</div>
	</div>


<!--SCRIPT-->
<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<script type="text/javascript" src="colresizable/colResizable-1.6.min.js"></script>
<script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/search.js"></script>
<script type="text/javascript">
	function validacion() {
		valor = document.getElementById("txtvalor").value;
		if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
			document.getElementById("txtvalor").css('border', '1px solid #a94442');
		  	return false;
		}
	}
</script>
<script>
    var Modal = (function() {

  var trigger = $qsa('.modal__trigger'); // what you click to activate the modal
  var modals = $qsa('.modal'); // the entire modal (takes up entire window)
  var modalsbg = $qsa('.modal__bg'); // the entire modal (takes up entire window)
  var content = $qsa('.modal__content'); // the inner content of the modal
	var closers = $qsa('.modal__close'); // an element used to close the modal
  var w = window;
  var isOpen = false;
	var contentDelay = 400; // duration after you click the button and wait for the content to show
  var len = trigger.length;

  // make it easier for yourself by not having to type as much to select an element
  function $qsa(el) {
    return document.querySelectorAll(el);
  }

  var getId = function(event) {

    event.preventDefault();
    var self = this;
    // get the value of the data-modal attribute from the button
    var modalId = self.dataset.modal;
    var len = modalId.length;
    // remove the '#' from the string
    var modalIdTrimmed = modalId.substring(1, len);
    // select the modal we want to activate
    var modal = document.getElementById(modalIdTrimmed);
    // execute function that creates the temporary expanding div
    makeDiv(self, modal);
  };

  var makeDiv = function(self, modal) {

    var fakediv = document.getElementById('modal__temp');

    /**
     * if there isn't a 'fakediv', create one and append it to the button that was
     * clicked. after that execute the function 'moveTrig' which handles the animations.
     */

    if (fakediv === null) {
      var div = document.createElement('div');
      div.id = 'modal__temp';
      self.appendChild(div);
      moveTrig(self, modal, div);
    }
  };

  var moveTrig = function(trig, modal, div) {
    var trigProps = trig.getBoundingClientRect();
    var m = modal;
    var mProps = m.querySelector('.modal__content').getBoundingClientRect();
    var transX, transY, scaleX, scaleY;
    var xc = w.innerWidth / 2;
    var yc = w.innerHeight / 2;

    // this class increases z-index value so the button goes overtop the other buttons
    trig.classList.add('modal__trigger--active');

    // these values are used for scale the temporary div to the same size as the modal
    scaleX = mProps.width / trigProps.width;
    scaleY = mProps.height / trigProps.height;

    scaleX = scaleX.toFixed(3); // round to 3 decimal places
    scaleY = scaleY.toFixed(3);


    // these values are used to move the button to the center of the window
    transX = Math.round(xc - trigProps.left - trigProps.width / 2);
    transY = Math.round(yc - trigProps.top - trigProps.height / 2);

		// if the modal is aligned to the top then move the button to the center-y of the modal instead of the window
    if (m.classList.contains('modal--align-top')) {
      transY = Math.round(mProps.height / 2 + mProps.top - trigProps.top - trigProps.height / 2);
    }


		// translate button to center of screen
		trig.style.transform = 'translate(' + transX + 'px, ' + transY + 'px)';
		trig.style.webkitTransform = 'translate(' + transX + 'px, ' + transY + 'px)';
		// expand temporary div to the same size as the modal
		div.style.transform = 'scale(' + scaleX + ',' + scaleY + ')';
		div.style.webkitTransform = 'scale(' + scaleX + ',' + scaleY + ')';


		window.setTimeout(function() {
			window.requestAnimationFrame(function() {
				open(m, div);
			});
		}, contentDelay);

  };

  var open = function(m, div) {

    if (!isOpen) {
      // select the content inside the modal
      var content = m.querySelector('.modal__content');
      // reveal the modal
      m.classList.add('modal--active');
      // reveal the modal content
      content.classList.add('modal__content--active');

      /**
       * when the modal content is finished transitioning, fadeout the temporary
       * expanding div so when the window resizes it isn't visible ( it doesn't
       * move with the window).
       */

      content.addEventListener('transitionend', hideDiv, false);

      isOpen = true;
    }

    function hideDiv() {
      // fadeout div so that it can't be seen when the window is resized
      div.style.opacity = '0';
      content.removeEventListener('transitionend', hideDiv, false);
    }
  };

  var close = function(event) {

		event.preventDefault();
    event.stopImmediatePropagation();

    var target = event.target;
    var div = document.getElementById('modal__temp');

    /**
     * make sure the modal__bg or modal__close was clicked, we don't want to be able to click
     * inside the modal and have it close.
     */

    if (isOpen && target.classList.contains('modal__bg') || target.classList.contains('modal__close')) {

      // make the hidden div visible again and remove the transforms so it scales back to its original size
      div.style.opacity = '1';
      div.removeAttribute('style');

			/**
			* iterate through the modals and modal contents and triggers to remove their active classes.
      * remove the inline css from the trigger to move it back into its original position.
			*/

			for (var i = 0; i < len; i++) {
				$('#modal3').removeClass('modal--active');
				$('.modal__content').removeClass('modal__content--active');
				trigger[i].style.transform = 'none';
        trigger[i].style.webkitTransform = 'none';
				trigger[i].classList.remove('modal__trigger--active');
			}

      // when the temporary div is opacity:1 again, we want to remove it from the dom
			div.addEventListener('transitionend', removeDiv, false);

      isOpen = false;

    }

    function removeDiv() {
      setTimeout(function() {
        window.requestAnimationFrame(function() {
          // remove the temp div from the dom with a slight delay so the animation looks good
          div.remove();
        });
      }, contentDelay - 50);
    }

  };

  var bindActions = function() {
    for (var i = 0; i < len; i++) {
      trigger[i].addEventListener('click', getId, false);
      closers[i].addEventListener('click', close, false);
      modalsbg[i].addEventListener('click', close, false);
    }
  };

  var init = function() {
    bindActions();
  };

  return {
    init: init
  };

}());

Modal.init();
</script>
</body>
</html>

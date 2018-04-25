var slideIndex = 1;
$(document).on("click",".sidebar-toggle",function(){
    $(".wrapper").toggleClass("toggled");
    return false;
});
$(document).on("click",".btn-search",function(){
    $(".form-search").toggle("slow");
    $('.form-search input:first').focus();
    return false;
});
$('#form-search').submit(function(event) {
	event.preventDefault();
	if(/^\s+$/.test($('#form-search input').val())){
		alert('ERROR, El Campo de busqueda esta vacio o contiene caracteres invalidos');
		$('#form-search input').val('');
		$('#form-search input').focus();
		return false;
	}
	$('#myTablequery tbody').empty();

	campo = $('#form-search input');
	area = $('#txtAT').val();
	valor = campo.val();

	$.ajax({
		url: 'search_exe.php',
		type: 'POST',
		data: 'id='+valor+'&AT='+area,
		statusCode: {
	    404: function() {
		      window.location = 'global/404error.php';
		    }
		  },

		beforeSend: function(){
			//alert('id='+valor+'&AT='+area);
			$('.loading').show();
			campo.prop('disabled', true);
		},
		success: function(data){
			$('#myTablequery tbody').append(data);
			campo.prop('disabled', false);
			campo.focus();
			setTimeout(function(){
				$('.loading').hide();
			},100);

		}
	});
});
$(document).on("click","#gallery",function(event){
    event.preventDefault();
    $('#myModalimg').empty();
    id = $(this).parents("tr").find("td").eq(5).text();
    //alert(id);
    $.ajax({
    	url: 'gallery_exe.php',
    	type: 'POST',
    	data: {id: id},

    	success: function(image){
    		$('#myModalimg').append(image);
    		$('#myModalimg').modal('show');

			showDivs(slideIndex);
    		//alert(image);
    	}
    });
});

$("#myTablequery").on("click", "#trash",function(event) {
	$("#panel").slideUp("slow");
	$("#panel").remove();
	event.preventDefault();
	fila = $(this).parents("tr");
	//alert(fila.find("td").eq(5).text());
	fila.after('<div id="panel">'+fila.find("td").eq(5).text()+'</div>');
	$("#panel").slideDown("slow");

});


function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = $(".mySlides");
  var dots = $(".demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}
  $("#myTablequery").colResizable({
  		liveDrag:true,
		draggingClass:"rangeDrag",
		gripInnerHtml:"<div class='rangeGrip'></div>",
		minWidth:8,
		resizeMode:'flex'
  });
  $('#myTablequery').on('click', '#modKey', function(){
  		$('#edit input[name="txtID"]').val('');
  		$('#edit input[name="txtkeyword"]').val('');
  		id = $(this).parents("tr").find("td").eq(5).text();
  		$('#edit').modal('show');
  		$('#edit .modal-content').show('slow');
  		$('#edit input[name="txtID"]').val(id);
  		$('#loading-02').fadeOut('500');
	  	$('#keyword').fadeIn('400');
	  	$('#edit input[name="txtkeyword"]').focus();
  });
$(document).ready(function(){

	  $('#keyword').submit(function(event) {
	  		event.preventDefault();

	  		campo = $('#edit input[name="txtkeyword"]').val();
	  		if(/^\s+$/.test(campo)){
	  			alert('error de campo');
	  			$('input[name="txtkeyword"]').val('');
	  			$('input[name="txtkeyword"]').focus();
	  			return false;
	  		}
	  		formSubmit = $(this).serialize();

	  		$.ajax({
	  			url: 'keyWord_exe.php',
	  			type: 'POST',
	  			data: formSubmit,

	  			beforeSend: function(){
	  				//console.log(campo);
	  				var $div = $('#edit input[name="txtkeyword"]').parents().closest('.form-group');
	  				var id = $('#edit input[name="txtID"]').val();
	  				//console.log($div);
	  				if (campo == '' ) {
			  			$div.addClass('has-error');
			  			$('#edit input[name="txtkeyword"]').focus();
			  			return false;
			  		}
			  		$div.removeClass('has-error');
	  				//$('#keyword').fadeOut('400');
	  				var modal = $('#edit');
	  				$('#edit .modal-content').hide('slow');
	  				//$('#edit').modal('hide');
						//modal.find('.modal-title').text('Aplicando cambios: ' + id);
	  				$('#loader').fadeIn('fast');

	  			},

	  			success: function(response){
	  				//alert(response);
	  				response= JSON.parse(response);
	  				$('#loader').fadeOut('fast');
	  				$('#edit').modal('hide');
	  				setTimeout(function() {
	  					$( ".nota-informativa" ).empty();
	  					if(response.respuesta == 'BAD'){$( ".nota-informativa" ).css('background-color', '#ce4844');
	  					}else{$( ".nota-informativa" ).css('background-color', '#5cb85c');}
	  					$( ".nota-informativa" ).html(response.mensaje);
	  					$( ".nota-informativa" ).show( "blind", { direction:'down' }, 1000 )
							                    .delay(2000)
							                    .hide( "blind", { direction:'down' }, 1000 );
	  				},1000);
	  				$('#form-search input[type="text"]').focus();
		  		}
	  		});
	  });
	$('#modal3 #enviarReporte').click(function(){
		//event.preventDefault();
		if($('#at').val() == ''){
			alert('Campo vacio, favor de seleccionar una opcion.');
			return false;
		}
		$('#formReport').submit();
		//alert('hola mundo');
	})
  
});

$(function() {
		$('.sidebar-nav li').removeClass('active');
      	$(".sidebar-nav li:eq(2)").addClass('active');
      	$(".sidebar-nav li:eq(2) a").click(function(event){
      		event.preventDefault();
      	});

	$('.inputedit').attr('disabled', true);
		fn_dar_eliminar();
		fn_cantidad();

		$('#listModal').on('show.bs.modal', function () {
			var height = $(window).height() - 200;
			$(this).find(".modal-body").css("max-height", height);
		});


		$('.cargar').attr('disabled', 'disabled');
		$('.listar').attr('disabled', 'disabled');
		$('.btn-add').attr('disabled', 'disabled');
		$('#txtid').attr('disabled', 'disabled');
		$('#txtcant').attr('disabled', 'disabled');

		$('#txtalmacen').change(function(){
			$(this).closest('.form-group').removeClass('has-error');
			if($(this).val() != ''){
				alm = $('#txtalmacen').val();
				  //console.log(alm);
				  $.ajax({
				  	url: 'list_prod_exe.php',
				  	type: 'POST',
				  	data: {almacen: alm},

				  	beforeSend: function(){
				  		$('#listModal .table tbody').empty();
				  	},

				  	success: function(response){
				  		$('#listModal .table tbody').append(response);
				  	}
				  });

				$('.listar').removeAttr('disabled');
				$('#txtid').removeAttr('disabled');
				$('input[name="txtid"]').focus();

			}else{
				$(this).closest('.form-group').addClass('has-error');
				$('.cargar').attr('disabled', 'disabled');
				$('.listar').attr('disabled', 'disabled');
				$('#txtid').attr('disabled', 'disabled');
			}


		});

		$('input[name="txtid"]').on('keyup', function() {
			//console.log('hola mundo.')
			if($(this).val().length > 0){
				$('.cargar').removeAttr('disabled');
				$('#txtcant').removeAttr('disabled');
			}else{
				$('.cargar').attr('disabled', 'disabled');
				$('#txtcant').attr('disabled', 'disabled');
			}
		});

		$('#txtcant').on('keyup', function() {
			//console.log('hola mundo.')
			if($(this).val().length > 0){
				$('.btn-add').removeAttr('disabled');
			}else{
				$('.btn-add').attr('disabled', 'disabled');
			}
		});


/**************************************************************************/

		//FILTER TABLE
        theTable = $(".table-search");
		  $("#input-search").keypress(function() {
			$.uiTableFilter(theTable, this.value);
		  });

		$('.table-search tbody').on('click','tr',function(){
			id = $(this).find("td").eq(1).text();
			//console.log(id);
			$('#listModal').modal('hide');
			$('#txtid').val(id);
			$('#txtid').focus();
			setTimeout(function(){
				$( ".cargar" ).trigger( "click" );
			},400);
		});
		$('.cargar').click(function(event) {
			event.preventDefault();
			id = $('#txtid').val();
			alm = $('#txtalmacen').val();
			$.ajax({
				url: 'list_prod_exe.php',
				type: 'POST',
				data: 'func=0&almacen='+alm+'&id='+id,

				beforeSend: function(){
					$('.validate').removeClass('has-error');
					$('#txtdescripcion').val('');
					$('#txtreferencia').val('');
					$('#txtsap').val('');
					$('#txtstock').val('');
					$('#txtmedida').val('');
					$('#txtcant').val('');
				},

				success: function(response){
					response= JSON.parse(response);
					//alert(response);
					if(response.respuesta == 'DONE'){
						$('#txtdescripcion').val(response.descripcion +' ('+response.idOpret+')');
						$('#txtreferencia').val(response.ref);
						$('#txtsap').val(response.sap);
						$('#txtstock').val(response.stock);
						$('#txtmedida').val(response.medida);
						$('#txtcant').focus();
					}
					else
					{
						$('.validate').addClass('has-error');
						$( ".nota-informativa" ).css('background-color', '#C00');
			  			$( ".nota-informativa" ).html(response.mensaje);
			  			$( ".nota-informativa" ).show( "blind", { direction:'down' }, 1000 )
									            .delay(2500)
									            .hide( "blind", { direction:'down' }, 1000 );

					}

				}
			});
		});
		var $table = $('.table'),
		    $bodyCells = $table.find('tbody tr:first').children(),
		    colWidth;

		// Get the tbody columns width array
		colWidth = $bodyCells.map(function() {
		    return $(this).width();
		}).get();

		// Set the width of thead columns
		$table.find('thead tr').children().each(function(i, v) {
		    $(v).width(colWidth[i]);
		});

		items = 0;

		$(document).on('keydown', 'body', function(event) {
	        if($('#txtdescripcion').val() != ''){
		        if(event.keyCode==113){ //F2
		            event.preventDefault();
		            if($('#txtcant').focus()){
		            	$('.btn-add').trigger('click');
		            }
		        }
		    }

	        if(event.keyCode==13){ //F3
	            event.preventDefault();
	            if($('#txtid').focus()){
	            	$('.cargar').trigger('click');
	            }
	        }
	     });

		$('.btn-add').on('click', function(){
			cantidad = $('#txtcant').val();
			stock = $('#txtstock').val();
			code = $('#txtid').val();
			almacen = $('#txtalmacen').val();
			mensaje = 0;
			producto ='';

			if (almacen == '') {
				mensaje = 1;
				campo = $('#txtalmacen');

			}
			else if(code == ''){
				mensaje = 2;
				campo = $('#txtid');
			}
			else if(cantidad == ''){
				mensaje = 3;
				campo = $('#txtcant');
			}

			if(mensaje != 0){
				$(".nota-informativa" ).empty();
				campo.parents('.form-group').addClass('has-error');
				campo.focus();
				$(".nota-informativa" ).css('background-color', '#C00');
			  	$(".nota-informativa" ).html('<p>Existen Campos vacio.</p>');
			  	$(".nota-informativa" ).show( "blind", { direction:'down' }, 1000 )
									            .delay(2500)
									            .hide( "blind", { direction:'down' }, 1000 );

			}else{

				if(cantidad <= 0){
					$(".nota-informativa" ).empty();
					$('#txtcant').parents('.form-group').addClass('has-error');
					$('#txtcant').focus();
					$(".nota-informativa" ).css('background-color', '#C00');
				  	$(".nota-informativa" ).html('<p>No es posible solicitar esta cantidad.</p>');
				  	$(".nota-informativa" ).show( "blind", { direction:'down' }, 1000 )
										            .delay(2500)
										            .hide( "blind", { direction:'down' }, 1000 );
					return false;
				}

				if(parseFloat(stock) < cantidad){
					$(".nota-informativa" ).empty();
					$('#txtcant').parents('.form-group').addClass('has-error');
					$('#txtcant').focus();
					$(".nota-informativa" ).css('background-color', '#C00');
				  	$(".nota-informativa" ).html('<p>La cantidad solicitada sobrepasa el total del producto.</p>');
				  	$(".nota-informativa" ).show( "blind", { direction:'down' }, 1000 )
										            .delay(2500)
										            .hide( "blind", { direction:'down' }, 1000 );
					return false;
				}

				$('#txtcant').closest('.form-group').removeClass('has-error');
				$('#txtid').closest('.form-group').removeClass('has-error');
				$('#txtalmacen').closest('.form-group').removeClass('has-error');

				items += 1;
				nota = 'Consumo';

				checked = $('#txtprestamo');
				if(checked.prop('checked')){
					nota = 'Préstamo';
				}

				producto += '<tr>';
				producto += '<td hidden>'+ items +'</td>';
				producto += '<td>'+ $('#txtdescripcion').val() +'</td>';
				producto += '<td>'+ $('#txtreferencia').val() +'</td>';
				producto += '<td>'+ $('#txtid').val() +'</td>';
				producto += '<td>'+ $('#txtmedida').val() +'</td>';
				producto += '<td>'+ $('#txtcant').val() +'</td>';
				producto += '<td hidden>'+ $('#txtalmacen').val() +'</td>';
				producto += '<td>'+nota+'</td>';
				producto += '<td></td>';
				producto += '<td><a href="#" class="eliminar" style="color: #C00;"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
				producto += '</tr>';

				$('#tableDetalles tbody').append(producto);
				$('input[type="text"]').val('');
				$('#txtprestamo').prop('checked', false);
				$('.btn-add').attr('disabled', 'disabled');
				fn_dar_eliminar();
				$('#badgecant').css("transform","scale(2)");
				$('#badgecant').css("-webkit-transform","scale(2)");
				setTimeout(function(){
					fn_cantidad();
				},10);
				setTimeout(function(){

					$('#badgecant').css("transform","scale(1)");
					$('#badgecant').css("-webkit-transform","scale(1)");
					$('#txtid').focus();
				},500);

			}
		});
/*************************************************************************/
			function fn_dar_eliminar(){
                $("a.eliminar").on('click',function(event){
                	event.preventDefault();
                	//alert('haz hecho click aqui!')	;
                    Item = $(this).parents("tr").find("td").eq(0).html();
					var parent = $(this).parents('tr').get(0);
					$(".nota-informativa" ).css('background-color', '#00C851');
				  	$(".nota-informativa" ).html('<p>El registros en la posicion No. '+ Item +' ha sido eliminado.</p>');
				  	$(".nota-informativa" ).show( "blind", { direction:'down' }, 1000 )
										            .delay(2500)
										            .hide( "blind", { direction:'down' }, 1000 );
					$(parent).remove();
					$('#txtid').focus();
					fn_cantidad();


                });
            }
/************************************************************************/
			function fn_cantidad(){
				cant0 = $("#tableDetalles tbody").find("tr").length;
				$("#span_cantidad").html(cant0);
				$('#badgecant').html(cant0).fadeIn('slow');
			}
/**************************************************************************/

		/*CHANGE TIPO SALIDA*/
		$('select[name="txtTipoSalida"]').change(function() {
			//console.log('hola mundo');
		    SNO = $('.noOficial');
		    valor = $(this);
		    contenedor = SNO.closest('li');
		    if(valor.val() == 2){
		    	contenedor.removeClass('hidden');
		    	SNO.trigger('click');
		    	f = new Date();
		    	$('#Ot').prop('readonly', 'readonly');
		    	$('#Ot').val(f.getFullYear()+''+f.getMonth()+''+f.getDay()+''+f.getSeconds());
		    	$('.input-group-select ul li:eq(0)').addClass('disabled');
		    	$('.input-group-select ul li:eq(1)').addClass('disabled');
		    }else{
		    	$('.input-group-select ul li:eq(0)').removeClass('disabled');
		    	$('.input-group-select ul li:eq(1)').removeClass('disabled');
		    	contenedor.addClass('hidden');
		    	$('.input-group-select ul li:first a').trigger('click');
		    	$('#Ot').prop('readonly', false);
		    	$('#Ot').val('');

		    }

		});
/***************************************************************************/

		var selectFormGroup = function (event) {
            event.preventDefault();

            var $selectGroup = $(this).closest('.input-group-select');
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();

            $selectGroup.find('.concept').text(concept);
            $selectGroup.find('.input-group-select-val').val(param);

        }

        $(document).on('click', '.dropdown-menu a', selectFormGroup);
/***********************************************************************/
		moment.locale('es');
		//var ahmet = moment("25/04/2012","DD/MM/YYYY").year();
		date = new Date();
		bugun = moment(date).format("YYYY-MM-DD");

		      var date_input=$('input[name="txtDate"]'); //our date input has the name "date"
		      var options={
		        //startDate: '+1d',
		        endDate: '+0d',
		        //container: container,
		        todayHighlight: true,
		        autoclose: true,
		        format: 'yyyy-mm-dd',
		        language: 'en',
		        //defaultDate: moment().subtract(15, 'days')
		        //setStartDate : "<DATETIME STRING HERE>"
		      };
		      date_input.val(bugun);
		      date_input.datepicker(options);
		$('.input-group').find('.glyphicon-calendar').on('click', function(){
			if( !date_input.data('datepicker').picker.is(":visible"))
			{
			       date_input.trigger('focus');
			}
		});
/*******************************************************************/
//ENVIAR EL FORMULARIO Y LOS DATOS AL PRESIONAR F2......
    $(document).keydown(function(event) {
        if(event.which == 114 ) { //F3
            //alert("Has presionado F3");
			$('#submit').trigger('click');
            return false;
        }
        //event.preventDefault();
	});
		$('#submit').click(function(){
			//Almacenamos los valores
				Tsalida=$('#txtTipoSalida');
				AT=$('select[name=txtAt]').val();
				OT=$('#Ot').val();
				fecha=$('input[name=txtDate]').val();

			//Comprobamos y mostramos diferentes clases
				if (AT == ''){
					Tsalida.parents().parents().children('label:eq(1)').empty();
					Tsalida.parents().parents().children('label:eq(1)').text('AT');
					Tsalida.parents().parents().children('label:eq(1)').append(' <i class="fa fa-exclamation-circle" style="color:#f70e05;" aria-hidden="true"></i>');

				}else{
					Tsalida.parents().parents().children('label:eq(1)').empty();
					Tsalida.parents().parents().children('label:eq(1)').text('AT');
				}
				if (OT == ''){
					Tsalida.parents().parents().children('label:eq(2)').empty();
					Tsalida.parents().parents().children('label:eq(2)').text('OT No.');
					Tsalida.parents().parents().children('label:eq(2)').append(' <i class="fa fa-exclamation-circle" style="color:#f70e05;" aria-hidden="true"></i>');

				}else{
					Tsalida.parents().parents().children('label:eq(2)').empty();
					Tsalida.parents().parents().children('label:eq(2)').text('OT NO.');
				}
				if (fecha == ''){
					Tsalida.parents().parents().children('label:eq(3)').empty();
					Tsalida.parents().parents().children('label:eq(3)').text('fecha');
					Tsalida.parents().parents().children('label:eq(3)').append(' <i class="fa fa-exclamation-circle" style="color:#f70e05;" aria-hidden="true"></i>');

				}else{
					Tsalida.parents().parents().children('label:eq(3)').empty();
					Tsalida.parents().parents().children('label:eq(3)').text('fecha');
				}
				//Si no hay ningun campo vacio enviamos el formulario
				if (AT =='' || OT == '' || fecha == ''){
					$(".nota-informativa" ).empty();
					$(".nota-informativa" ).css('background-color', '#C00');
				  	$(".nota-informativa" ).html('<p>Existen campos vacios.</p>');
				  	$(".nota-informativa" ).show( "blind", { direction:'down' }, 1000 )
										            .delay(2500)
										            .hide( "blind", { direction:'down' }, 1000 );
					//return false;
				}else{
					fn_dar_enviar();
				}

		});
		function fn_dar_enviar(){
			var DATA 	= [];
			if ($('#tableDetalles >tbody >tr').length == 0){
					$(".nota-informativa" ).empty();
					$(".nota-informativa" ).css('background-color', '#C00');
				  	$(".nota-informativa" ).html('<p>No existen Items a solicitar.</p>');
				  	$(".nota-informativa" ).show( "blind", { direction:'down' }, 1000 )
										            .delay(2500)
										            .hide( "blind", { direction:'down' }, 1000 );
				return false;

			}else{
			//RECORREMOS LA TABLA DE DETALLES PARA GUARDAR EN VARIABLES SUS DATOS.
			$("#tableDetalles tbody tr").each(function (index){
			var campo1, campo2, campo3, campo4;
			$(this).children("td").each(function (index2){
				switch (index2) {
					case 3:
						campo1 = $(this).text();
					break;
					case 5:
						campo2 = $(this).text();
					break;
					case 6:
						campo3 = $(this).text();
					break;
					case 7:
						campo4 = $(this).text();
					break;
				}
			});//final each para index2

			//entonces declaramos un array para guardar estos datos, lo declaramos dentro del each para así reemplazarlo y cada vez
			item = {};
			//si miramos el HTML vamos a ver un par de TR vacios y otros con el titulo de la tabla, por lo que le decimos a la función que solo se ejecute y guarde estos datos cuando exista la variable ID, si no la tiene entonces que no anexe esos datos.
				if (campo2 !== ''){
					item ["id"] = campo1;
					item ["cantidad"] = campo2;
					item ["almacen"] = campo3;
					item ["condicion"] = campo4;
					//una vez agregados los datos al array "item" declarado anteriormente hacemos un .push() para agregarlos a nuestro array principal "DATA".
					DATA.push(item);
				}
			});//final del each index
			console.log(DATA);
			var fila = $("#tableDetalles tbody").find("tr").length;
			//eventualmente se lo vamos a enviar por PHP por ajax de una forma bastante simple y además convertiremos el array en json para evitar cualquier incidente con compativilidades.
				var INFO 	= new FormData();
				aInfo 	= JSON.stringify(DATA);

				INFO.append('data', aInfo);
				INFO.append('TipoFactura', $('#txtTipoSalida').val());
				INFO.append('AT', $('select[name="txtAt"]').val());
				INFO.append('OT', $('#type').val()+' '+$('#Ot').val());
				INFO.append('fecha', $('input[name="txtDate"]').val());
				INFO.append('comentarios', $('textarea[name="comentarios"]').val());
				INFO.append('fila', fila);

			//var valores = (aInfo).serializeArray();
			//alert(variables);

						$.ajax({
							type:'POST',//TIPO DE PETICION PUEDE SER GET
							dataType:"json",//EL TIPO DE DATO QUE DEVUELVE PUEDE SER JSON/TEXT/HTML/XML
							url:"salida_exe.php",//DIRECCION DONDE SE ENCUENTRA LA OPERACION A REALIZAR
							data:INFO,
							cache: false,
							processData: false,
							contentType: false,
							statusCode: {
							    404: function() {
							      window.location = '../global/404error.php';
							    }
							},

							beforeSend: function(){
								$('#loader').show();
								$('.input-edit').prop('readonly', true);
							},

							  success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
									//response = parseJSON(response);
									if(response.respuesta == 'DONE'){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
										//console.log(response.mensaje);
										$(".nota-informativa" ).empty();
										$(".nota-informativa" ).css('background-color', '#07f124');
										$(".nota-informativa").css('box-shadow', '0 16px 26px -10px rgba(13, 212, 28, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.05), 0 8px 10px -5px rgba(83, 244, 54, 0.2)');
									  	$(".nota-informativa" ).html('<p>'+response.mensaje+'.</p>');
									  	$(".nota-informativa" ).show( "blind", { direction:'down' }, 1000 )
															   .delay(2500)
															   .hide( "blind", { direction:'down' }, 1000 );
										$('#loader').hide();
										var caracteristicas = "width=1000,height=450,top=100,left=200,scrollTo,resizable=1,scrollbars=1,location=0";
										//var caracteristicas = "width=1000,height=450,top=100,left=200,toolbar=no,location=0,status=no,menubar=no";
										var link = 'print-salida.php?ot=' + $('#type').val()+ ' ' + $('#Ot').val();
										window.open (link,"Ventana_Salida",caracteristicas);
										setTimeout(function(){
											window.location = 'salida.php';
										},500);

									}else{
										//alert(response.mensaje);
										$(".nota-informativa" ).empty();
										$(".nota-informativa" ).css('background-color', '#f44336');
										$(".nota-informativa").css('box-shadow', '0 16px 26px -10px rgba(244, 67, 54, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(244, 67, 54, 0.2)');
									  	$(".nota-informativa" ).html('<p>'+response.mensaje+'.</p>');
									  	$(".nota-informativa" ).show( "blind", { direction:'down' }, 1000 )
															   .delay(2500)
															   .hide( "blind", { direction:'down' }, 1000 );
										$('#loader').hide();
									}

							  }
						});//final ajax

		}//final del else

	};//function enviar();
/*************************************************************************************************/
});

// JavaScript Document
    function permite(elEvento, permitidos) {
      // Variables que definen los caracteres permitidos
      var numeros = "0123456789";
      var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
      var numeros_caracteres = numeros + caracteres;
      var teclas_especiales = [8, 37, 39, 46];
      // 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
     
     
      // Seleccionar los caracteres a partir del parámetro de la función
      switch(permitidos) {
        case 'num':
          permitidos = numeros;
          break;
        case 'car':
          permitidos = caracteres;
          break;
        case 'num_car':
          permitidos = numeros_caracteres;
          break;
      }
     
      // Obtener la tecla pulsada
      var evento = elEvento || window.event;
      var codigoCaracter = evento.charCode || evento.keyCode;
      var caracter = String.fromCharCode(codigoCaracter);
     
      // Comprobar si la tecla pulsada es alguna de las teclas especiales
      // (teclas de borrado y flechas horizontales)
      var tecla_especial = false;
      for(var i in teclas_especiales) {
        if(codigoCaracter == teclas_especiales[i]) {
          tecla_especial = true;
          break;
        }
      }
     
      // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
      // o si es una tecla especial
      return permitidos.indexOf(caracter) != -1 || tecla_especial;
    }

	
			var patron = new Array(3,3,4);
			var CodCliente = new Array(1,8);
			var patron2 = new Array(3,7,1);
			function mascara(d,sep,pat,nums){
			if(d.valant != d.value){
				val = d.value
				largo = val.length
				val = val.split(sep)
				val2 = ''
				for(r=0;r<val.length;r++){
					val2 += val[r]	
				}
				if(nums){
					for(z=0;z<val2.length;z++){
						if(isNaN(val2.charAt(z))){
							letra = new RegExp(val2.charAt(z),"g")
							val2 = val2.replace(letra,"")
						}
					}
				}
				val = ''
				val3 = new Array()
				for(s=0; s<pat.length; s++){
					val3[s] = val2.substring(0,pat[s])
					val2 = val2.substr(pat[s])
				}
				for(q=0;q<val3.length; q++){
					if(q ==0){
						val = val3[q]
					}
					else{
						if(val3[q] != ""){
							val += sep + val3[q]
							}
					}
				}
				d.value = val
				d.valant = val
				}
			}
// JavaScript Document
function requerir(){
            try{
              req= new XMLHttpRequest();
            }
            catch(err1)
            {
              try{
                req= new ActiveXObject("Microsoft.XMLHTTP");
              }catch(err2){
                try{
                  req= new ActiveXObject("Msxm12.XMLHTTP"); 
                }catch(err3){
                  req=false;
                }
              }
            }
            return req;
          }

          var peticion=requerir();

          function llamarAjaxGETpro(){
            var aleatorio=parseInt(Math.random()*999999999);
            valor=document.getElementById("linea").value;
            var url="../class/Activos.php?valor="+valor+"&r="+aleatorio;
            peticion.open("GET",url,true);
            peticion.onreadystatechange =respuestaAjaxpro;
            peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            peticion.send(null);
          }

          function respuestaAjaxpro(){
            if (peticion.readyState == 4) {
              if(peticion.status == 200){
                document.getElementById("ubicacion").innerHTML=peticion.responseText;
              }else{
                alert("Ha Ocurrido un Error"+peticion.statusText);
              }
            }
          }

//final del jquery para los datos y las respuestas rapidas

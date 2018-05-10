<!DOCTYPE html>
<html>
  <head>
    <title>IP real</title>
  </head>
  <body>
    Mi IP Local es: <input type="text" readonly id="ipId1"><br>
     Browser Info: <p id="version"></p>

    <script>
        //obtiene la direccion IP:
   function getIPs(callback){
       var ip_dups = {};

       //compatibilidad exclusiva de firefox y chrome, el usuario @guzgarcia compartio este enlace muy util: http://iswebrtcreadyyet.com/
       var RTCPeerConnection = window.RTCPeerConnection
           || window.mozRTCPeerConnection
           || window.webkitRTCPeerConnection;
       var useWebKit = !!window.webkitRTCPeerConnection;

       //bypass naive webrtc blocking using an iframe
       if(!RTCPeerConnection){
           //NOTE: necesitas tener un iframe in la pagina, exactamente arriba de la etiqueta script
           //
           //<iframe id="iframe" sandbox="allow-same-origin" style="display: none"></iframe>
           //<script>... se llama a la funcion getIPs aqui...
           //
           var win = iframe.contentWindow;
           RTCPeerConnection = win.RTCPeerConnection
               || win.mozRTCPeerConnection
               || win.webkitRTCPeerConnection;
           useWebKit = !!win.webkitRTCPeerConnection;
       }

       //requisitos minimos para conexion de datos
       var mediaConstraints = {
           optional: [{RtpDataChannels: true}]
       };

       var servers = {iceServers: [{urls: "stun:stun.services.mozilla.com"}]};

       //construccion de una nueva RTCPeerConnection
       var pc = new RTCPeerConnection(servers, mediaConstraints);

       function handleCandidate(candidate){
           // coincidimos con la direccion IP
           var ip_regex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/
           var ip_addr = ip_regex.exec(candidate)[1];

           //eliminamos duplicados
           if(ip_dups[ip_addr] === undefined)
               callback(ip_addr);

           ip_dups[ip_addr] = true;
       }

       //escuchamos eventos candidatos
       pc.onicecandidate = function(ice){

           //dejamos de lado a los eventos que no son candidatos
           if(ice.candidate)
               handleCandidate(ice.candidate.candidate);
       };

       //creamos el canal de datos
       pc.createDataChannel("");

       //creamos un offer sdp
       pc.createOffer(function(result){

           //disparamos la peticion (request) al stun server (para entender mejor debemos ver la documentacion de WebRTC.
           pc.setLocalDescription(result, function(){}, function(){});

       }, function(){});

       //esperamos un rato para dejar que todo se complete:
       setTimeout(function(){
           //leemos la informacion del candidato desde la descripcion local
           var lines = pc.localDescription.sdp.split('\n');

           lines.forEach(function(line){
               if(line.indexOf('a=candidate:') === 0)
                   handleCandidate(line);
           });
       }, 1000);
   }

   //Llego la hora de la verdad! vamos a probar: con esto veremos nuestra IP Local:
   getIPs(function(ip){document.getElementById('ipId1').value= ip});

   //Obtenemos la informacion del navegador
   var txt = "";
    txt += "<p>Browser CodeName: " + navigator.appCodeName + "</p>";
    txt += "<p>Browser Name: " + navigator.appName + "</p>";
    txt += "<p>Browser Version: " + navigator.appVersion + "</p>";
    txt += "<p>Cookies Enabled: " + navigator.cookieEnabled + "</p>";
    txt += "<p>Browser Language: " + navigator.language + "</p>";
    txt += "<p>Browser Online: " + navigator.onLine + "</p>";
    txt += "<p>Platform: " + navigator.platform + "</p>";
    txt += "<p>User-agent header: " + navigator.userAgent + "</p>";
   document.getElementById('version').innerHTML = txt;

document.write(document.getElementById('ipId1').value);

    </script>
    <?php
     $variablePHP = '<script type="text/javascript">document.getElementById("ipId1").text;</script>';
     echo "variablePHP = ".$variablePHP;
    ?>
  </body>
</html>

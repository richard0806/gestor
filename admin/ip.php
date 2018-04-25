<!DOCTYPE html>
<html>
  <head>
    <title>IP real</title>
  </head>
  <body>
     Mi IP es: <strong id="ipId"></strong>

    <script type="text/javascript">
        function get_ip(obj){
            document.getElementById('ipId').innerHTML = obj.ip;
        }
    </script>
    <script type="text/javascript" src="https://api.ipify.org/?format=jsonp&callback=get_ip"></script>
  </body>
</html>
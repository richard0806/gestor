<?php error_reporting (0);?>
<?php
//<!-- NAVBAR
//================================================== -->
if($_SESSION['user'] == "userAdmin"){
	$link = '../admin/index.php';
	$passw = 'Password.php';
}else{		
	$link = '../user/index.php';
	$passw = '../admin/Password.php';
	}
echo'

  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand"><img src="../cssalmacen/img/icon_gestor.png" width="60" height="60" alt="logo"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse"> 
	';
//Inicio del menu!!
echo '<ul class="nav navbar-nav">';
//La opcion Inicio va estar presente en todos los perfiles!!!
echo '<li class="active"><a href='.$link.'>Home<span class="sr-only">(current)</span></a></li>';

$objmenu = new Pmenu();

$menu = $objmenu->show_menu();

while($rowMenu=mysql_fetch_array($menu)){
	if(in_array($rowMenu['idModule'],$_SESSION['modules'])){
		if ($rowMenu['nameMenu'] == "Averias"){
			echo '<li><a href="'.URL.$rowMenu['linkMenu'].'">'.$rowMenu['nameMenu'].' <span class="badge">0</span></a></li>';
		}else if($rowMenu['nameMenu'] == "Salidas"){
			echo '<li><a href="'.URL.$rowMenu['linkMenu'].'">'.$rowMenu['nameMenu'].' <span class="badge">0</span></a></li>';
		}else if($rowMenu['nameMenu'] == "Devoluciones"){
			if(in_array('19',$_SESSION['roles'])){
				echo '<li><a href="'.URL.$rowMenu['linkMenu'].'">'.$rowMenu['nameMenu'].'</li>';
			}else{
				echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" onClick="return false">'.$rowMenu['nameMenu'].'</li>';
			}
		}else if($rowMenu['nameMenu'] == "Reportes"){
			if(in_array('23',$_SESSION['roles'])){
				echo '<li><a href="'.URL.$rowMenu['linkMenu'].'">'.$rowMenu['nameMenu'].'</a></li>';
			}else{
				echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" onClick="return false">'.$rowMenu['nameMenu'].'</a></li>';
			}
		}
			else{
		echo '<li><a href="'.URL.$rowMenu['linkMenu'].'">'.$rowMenu['nameMenu'].'</a></li>';}	
		
	}
}

//El logout va a estar presente en todos los perfiles!!!

//fin del menu
echo '</ul>';
echo'
	<ul class="nav navbar-nav navbar-right">
              <li></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> '.$_SESSION['user'].' <span class="glyphicon glyphicon-cog"> </span> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#"> Perfile</a></li>
                  <li><a href="#"> Cuenta</a></li>
                  <li><a href='.$passw.'><span class="glyphicon glyphicon-cog"></span> configuración</a></li>
                  <li class="divider"></li>
                  <li><a style="cursor:pointer;" id="exit"><i class="glyphicon glyphicon-log-out"></i> Cerrar Sesión</a></li>
                </ul>
';

echo'</div><!--/.nav-collapse -->
      </div>
    </nav>      
   
	';
	 //<!-- FINAL NAVBAR
	//=============================================== -->
?>

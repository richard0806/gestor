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
	<nav class="navbar navbar-default navbar-fixed-top topbar">
		<div class="container-fluid" style="box-shadow: 0px 2px 4px #000;background: #333;">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">
					<span class="visible-xs">GMant.</span>
					<span class="hidden-xs">GMant.</span>
				</a>

				<p class="navbar-text">
					<a href="#" class="sidebar-toggle">
                        <i class="fa fa-bars"></i>
                    </a>
				</p>
			</div>

			<div class="navbar-collapse collapse" id="navbar-collapse-main">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<label class="bienvenida">
							<img src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" class="img-circle" width="30"> Bienvenido '.$_SESSION["user"].'</label>
					</li>
                    <li><a href="#" class="hvr-bounce-to-top"><i class="fa fa-cog fa-lg" aria-hidden="true"></i></a></li>
                    <li><a href="../global/log_out.php" class="hvr-bounce-to-top"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</nav>
	<article class="wrapper">
	<aside class="sidebar" style="top: 50px;overflow: hidden;">
	        <ul class="sidebar-nav" style="padding-top: 15px;">
	        	<!--li class="close-toggle">
	        		<a href="#" class="sidebar-toggle"><span><i class="fa fa-times fa-2x" aria-hidden="true"></i></span>
                    </a>
                </li-->

	';
//Inicio del menu!!
//La opcion Inicio va estar presente en todos los perfiles!!!
echo '<li class="active"><a href="'.URL.'admin/" class="hvr-bounce-to-left"><span> <i class="fa fa-dashboard fa-lg"></i> Dashboard</span></a></li>';

$objmenu = new Pmenu();

$menu = $objmenu->show_menu($con);

while($rowMenu=mysqli_fetch_array($menu,MYSQLI_ASSOC)){
	if(in_array($rowMenu['idModule'],$_SESSION['modules'])){
		if ($rowMenu['nameMenu'] == "Averias"){
			echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" class="hvr-bounce-to-left"><span><i class="fa fa-cogs" aria-hidden="true"></i> '.$rowMenu['nameMenu'].' <span class="badge">0</span></span></a></li>';
		}else if($rowMenu['nameMenu'] == "Salidas"){
			echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" class="hvr-bounce-to-left"><span><i class="fa fa-mail-forward" aria-hidden="true"></i>'.$rowMenu['nameMenu'].' <span class="badge">0</span></span></a></li>';
		}else if($rowMenu['nameMenu'] == "Devoluciones"){
			if(in_array('19',$_SESSION['roles'])){
				echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" class="hvr-bounce-to-left"><span><i class="fa fa-reply" aria-hidden="true"></i> '.$rowMenu['nameMenu'].'</span></li>';
			}else{
				echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" class="hvr-bounce-to-left" onClick="return false"><span><i class="fa fa-reply" aria-hidden="true"></i> '.$rowMenu['nameMenu'].'</span></li>';
			}
		}else if($rowMenu['nameMenu'] == "Reportes"){
			if(in_array('23',$_SESSION['roles'])){
				echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" class="hvr-bounce-to-left"><span><i class="fa fa-pie-chart" aria-hidden="true"></i> '.$rowMenu['nameMenu'].'</span></a></li>';
			}else{
				echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" class="hvr-bounce-to-left" onClick="return false"><span><i class="fa fa-pie-chart" aria-hidden="true"></i> '.$rowMenu['nameMenu'].'</span></a></li>';
			}
		}else if($rowMenu['nameMenu'] == "Transferencia"){
			echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" class="hvr-bounce-to-left"><span><i class="fa fa-random" aria-hidden="true"></i> '.$rowMenu['nameMenu'].'</span></a></li>';
		}
		else if($rowMenu['nameMenu'] == "Usuarios"){
			echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" class="hvr-bounce-to-left"><span><i class="fa fa-user" aria-hidden="true"></i> '.$rowMenu['nameMenu'].'</span></a></li>';
		}else if($rowMenu['nameMenu'] == "Entradas"){
			echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" class="hvr-bounce-to-left"><span><i class="fa fa-plus-square-o" aria-hidden="true"></i> '.$rowMenu['nameMenu'].'</span></a></li>';
		}


			else{
		echo '<li><a href="'.URL.$rowMenu['linkMenu'].'" class="hvr-bounce-to-left"><span><i class="fa fa-list-ul" aria-hidden="true"></i> '.$rowMenu['nameMenu'].'</span></a></li>';}

	}
}

//El logout va a estar presente en todos los perfiles!!!

//fin del menu
echo '</ul>
	    </aside>
	    	</article>
';

	 //<!-- FINAL NAVBAR
	//=============================================== -->
?>

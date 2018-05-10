<?php
	require'../global/objects.php';
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<?php include_once '../global/header.php' ?>
 	<title>HOME | Gestor Mant.</title>
	<style>
		.container{
			padding-top: 50px;
		}
		h5 {
		    font-size: 1.28571429em;
		    font-weight: 700;
		    line-height: 1.2857em;
		    margin: 0;
		}
		.col-sm-6{
			padding-bottom: 30px;
		}
		.card {
		    font-size: 1em;
		    overflow: hidden;
		    padding: 0;
		    border: none;
		    border-radius: .28571429rem;
		    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
		}

		.card-block {
		    font-size: 1em;
		    position: relative;
		    margin: 0;
		    padding: 1em;
		    border: none;
		    border-top: 1px solid rgba(34, 36, 38, .1);
		    box-shadow: none;
		}

		.card-img-top {
		    display: block;
		    width: 100%;
		    height: auto;
		}

		.card-title {
		    font-size: 1.28571429em;
		    font-weight: 700;
		    line-height: 1.2857em;
		}

		.card-text {
		    clear: both;
		    margin-top: .5em;
		    color: rgba(0, 0, 0, .68);
		}

		.card-footer {
		    font-size: 1em;
		    position: static;
		    top: 0;
		    left: 0;
		    max-width: 100%;
		    padding: .75em 1em;
		    color: rgba(0, 0, 0, .4);
		    border-top: 1px solid rgba(0, 0, 0, .05) !important;
		    background: #fff;
		    padding-right: 0px;

		}

		.card-inverse .btn {
			border-radius: 0px;
			border-bottom-left-radius: 25px ;
			border-top-right-radius: 25px;
			padding: 5px 25px 5px 25px;
		    border: 1px solid rgba(0, 0, 0, .05);
		}

		.profile {
		    position: absolute;
		    top: -12px;
		    display: inline-block;
		    overflow: hidden;
		    box-sizing: border-box;
		    width: 25px;
		    height: 25px;
		    margin: 0;
		    border: 1px solid #fff;
		    border-radius: 50%;
		}

		.profile-avatar {
		    display: block;
		    width: 100%;
		    height: auto;
		    border-radius: 50%;
		}

		.profile-inline {
		    position: relative;
		    top: 0;
		    display: inline-block;
		}

		.profile-inline ~ .card-title {
		    display: inline-block;
		    margin-left: 4px;
		    vertical-align: top;
		}

		.text-bold {
		    font-weight: 700;
		}

		.meta {
		    font-size: 1em;
		    color: rgba(0, 0, 0, .4);
		}

		.meta a {
		    text-decoration: none;
		    color: rgba(0, 0, 0, .4);
		}

		.meta a:hover {
		    color: rgba(0, 0, 0, .87);
		}
	</style>
 </head>
 <body>

	<?php include_once '../global/menu.php'; ?>

	<div class="container">
				<?php //Validar los permisos del Usuarios.
				if(in_array('21',$_SESSION['roles'])){
				?>
						<div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card card-inverse card-info">
                  <img class="card-img-top" src="../css/image/entradas.png">
                  <div class="card-block">
                  	<h4 class="card-title">Entradas</h4>
                      <div class="card-text">
                          Entradas de productos.
                      </div>
                  </div>
                  <div class="card-footer">
                      <a href="<?= URL.'admin/entrada.php'?>" class="btn btn-primary pull-right btn-sm">Entrar</a>
                  </div>
                </div>
            </div>
						<?php
					}if(in_array('11',$_SESSION['roles'])){
						?>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card card-inverse card-info">
                    <img class="card-img-top" src="../css/image/salidas.png">
                    <div class="card-block">
                        <h4 class="card-title">Salidas</h4>
                        <div class="card-text">
                            Salidas de productos.
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?= URL.'admin/salida.php'?>" class="btn btn-primary pull-right btn-sm">Entrar</a>
                    </div>
                </div>
            </div>
						<?php
					} if(in_array('19',$_SESSION['roles'])){
						?>
						<div class="col-sm-6 col-md-4 col-lg-3 mt-4">
								<div class="card card-inverse card-info">
										<img class="card-img-top" src="../css/image/nc.png">
										<div class="card-block">
												<h4 class="card-title">Devoluciones</h4>
												<div class="card-text">
														Devolución de productos.
												</div>
										</div>
										<div class="card-footer">
												<a href="<?= URL.'admin/devolucion.php'?>" class="btn btn-primary pull-right btn-sm">Entrar</a>
										</div>
								</div>
						</div>
						<?php
					}if(in_array('24',$_SESSION['roles'])){
						?>
						<div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card card-inverse card-info">
                    <img class="card-img-top" src="../css/image/transfer.png">
                    <div class="card-block">
                        <h4 class="card-title">Transferencias</h4>
                        <div class="card-text">
                            Mover productos entre Almacén.
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?= URL.'admin/transferencia.php'?>" class="btn btn-primary pull-right btn-sm">Entrar</a>
                    </div>
                </div>
            </div>
						<?php
					}if(in_array('23',$_SESSION['roles'])){
						?>
             <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card card-inverse card-info">
                    <img class="card-img-top" src="../css/image/reportes.png">
                    <div class="card-block">
                        <h4 class="card-title">Reportes</h4>
                        <div class="card-text">
                            Reportes Movimientos en sistema.
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?= URL.'admin/reportes.php'?>" class="btn btn-primary pull-right btn-sm">Entrar</a>
                    </div>
                </div>
            </div>
						<?php
					}if(in_array('15',$_SESSION['roles'])){
						?>
						 <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
								<div class="card card-inverse card-info">
										<img class="card-img-top" src="../css/image/averias.png">
										<div class="card-block">
												<h4 class="card-title">Averias</h4>
												<div class="card-text">
														Averias de productos activos.
												</div>
										</div>
										<div class="card-footer">
												<a href="<?= URL.'admin/averias.php'?>" class="btn btn-primary pull-right btn-sm">Entrar</a>
										</div>
								</div>
						</div>
						<?php
					}
						?>
	</div>


 </body>
 </html>

<?php

session_start();

if (!isset($_SESSION['usua_sahilices']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');
include ('../includes/base.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();
$baseHTML = new BaseHTML();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_sahilices'],"Dashboard",$_SESSION['refroll_sahilices'],'');

$configuracion = $serviciosReferencias->traerConfiguracion();

$tituloWeb = mysql_result($configuracion,0,'sistema');

$breadCumbs = '<a class="navbar-brand" href="../index.php">Dashboard</a>';



/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "";

$plural = "";

$eliminar = "";

$insertar = "";

//$tituloWeb = "Gestión: Talleres";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
if ($_SESSION['idroll_sahilices'] == 2) {
	$idcliente = $_SESSION['idcliente'];
	$resCliente = $serviciosReferencias->traerClientesPorId($idcliente);
} else {
	$cabeceras 		= "	<th>Apellido y Nombre</th>
					<th>Categoria</th>
					<th>Año</th>
					<th>Mes</th>";
	//$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerArchivosGrid(),89);
}


///////////////////////////              fin                   ////////////////////////

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $tituloWeb; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <?php echo $baseHTML->cargarArchivosCSS('../'); ?>

	 <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

	 <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

	 <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

    <style>
        .alert > i{ vertical-align: middle !important; }
    </style>

</head>

<body class="theme-indigo">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="Ingrese palabras...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <?php echo $baseHTML->cargarNAV($breadCumbs); ?>
    <!-- #Top Bar -->
    <?php echo $baseHTML->cargarSECTION($_SESSION['usua_sahilices'], $_SESSION['nombre_sahilices'], str_replace('..','../dashboard',$resMenu),'../'); ?>
    <main id="app">
    <section class="content" style="margin-top:-35px;">

		<div class="container-fluid">
			<!-- Widgets -->
			<div class="row clearfix">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php if ($_SESSION['idroll_predio'] == 1) { ?>
						<h3>Buscar Clientes</h3>
						<?php } else { ?>
						<h3>Cliente</h3>

						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php if ($_SESSION['idroll_predio'] == 1) { ?>
	        	<div class="form-group col-md-12">
                     <h4>Busqueda por Nombre Completo o CUIT</h4>


					<input id="lstjugadores" style="width:75%;">


					<div id="selction-ajax" style="margin-top: 10px;"></div>
                </div>

                <div class="form-group col-md-12">
                    <div class="cuerpoBox" id="resultadosJuagadores">

                    </div>

                    <div class="cuerpoBox" id="resultadosArchivos">

                    </div>
                </div>

                <div class="form-group col-md-12">
                	<div class="panel panel-primary">
					  <div class="panel-heading">Archivos</div>
					  <div class="panel-body"><?php echo $lstCargados; ?></div>
					</div>

                </div>
                <?php } else { ?>
                <ul class="list-group">
	              <li class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-user"></span> Cliente - (<span style="color:#F00;">*</span> Datos No editables)</li>
	              <li class="list-group-item list-group-item-default">Apellido: <input type="text" class="form-control sinborde" name="apellido" id="apellido" value="<?php echo mysql_result($resCliente,0,'apellido'); ?>" /></li>
	              <li class="list-group-item list-group-item-default">Nombre: <input type="text" class="form-control sinborde" name="nombre" id="nombre" value="<?php echo mysql_result($resCliente,0,'nombre'); ?>" /></li>
	              <li class="list-group-item list-group-item-default">CUIT: <input type="text" class="form-control sinborde" name="cuit" id="cuit" value="<?php echo mysql_result($resCliente,0,'cuit'); ?>" /></li>
	              <li class="list-group-item list-group-item-default">Dirección: <input type="text" style="width:100%;" class="form-control sinborde" name="direccion" id="direccion" value="<?php echo mysql_result($resCliente,0,'direccion'); ?>" /></li>
	              <li class="list-group-item list-group-item-default">Tel. Fijo: <input type="text" class="form-control sinborde" name="telefono" id="telefono" value="<?php echo mysql_result($resCliente,0,'telefono'); ?>" /></li>
	              <li class="list-group-item list-group-item-default">Tel. Movil: <input type="text" class="form-control sinborde" name="celular" id="celular" value="<?php echo mysql_result($resCliente,0,'celular'); ?>" /></li>
	              <li class="list-group-item list-group-item-default"><span style="color:#F00;">*</span> Email: <?php echo mysql_result($resCliente,0,'email'); ?></li>
	              <li class="list-group-item list-group-item-default">
	                <ul class="list-inline">
	                    <li>Modificar Cliente:</li>
	                    <li><button type="button" class="btn btn-warning" id="modificarCliente" style="margin-left:0px;">Modificar</button></li>
	                    <li id="mensaje"></li>
	                </ul>
	              </li>
	            </ul>

	            <div class="cuerpoBox" id="resultadosArchivos">

                </div>

                <?php } ?>
					</div>
				</div>

			</div>
		</div>


    </section>




    </main>

    <?php echo $baseHTML->cargarArchivosJS('../'); ?>

	 <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

	 <!-- Jquery CountTo Plugin Js -->
    <script src="../plugins/jquery-countto/jquery.countTo.js"></script>

	 <!-- Morris Plugin Js -->
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="../plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->


    <!-- Sparkline Chart Plugin Js -->
    <script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <script src="../js/pages/index.js"></script>
	 <script src="../js/demo.js"></script>


    <script>
        $(document).ready(function(){

        });
    </script>



</body>
<?php } ?>
</html>

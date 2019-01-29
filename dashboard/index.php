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

<body class="theme-red">

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
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						 <div class="info-box bg-green hover-expand-effect">
							  <div class="icon">
									<i class="material-icons">ring_volume</i>
							  </div>
							  <div class="content">
									<div class="text">NUEVAS OPORTUNIDADES</div>
									<div class="number count-to" data-from="0" data-to="15" data-speed="15" data-fresh-interval="20"></div>
							  </div>
						 </div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						 <div class="info-box bg-cyan hover-expand-effect">
							  <div class="icon">
									<i class="material-icons">monetization_on</i>
							  </div>
							  <div class="content">
									<div class="text">COTIZACIONES</div>
									<div class="number count-to" data-from="0" data-to="0" data-speed="1000" data-fresh-interval="20"></div>
							  </div>
						 </div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						 <div class="info-box bg-red hover-expand-effect">
							  <div class="icon">
									<i class="material-icons">watch_later</i>
							  </div>
							  <div class="content">
									<div class="text">DEMORA OPORTUNIDADES</div>
									<div class="number count-to" data-from="0" data-to="3" data-speed="1000" data-fresh-interval="20"></div>
							  </div>
						 </div>
					</div>

			  </div>
			  <!-- #END# Widgets -->

			  <div class="row clearfix">
					<!-- Visitors -->
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						 <div class="card">
							  <div class="body bg-pink">
									<div class="m-b--35 font-bold">OPORTUNIDADES</div>
									<ul class="dashboard-stat-list">
										 <li>
											  HOY
											  <span class="pull-right"><b>1 200</b> <small>CARGADAS</small></span>
										 </li>
										 <li>
											  AYER
											  <span class="pull-right"><b>3 872</b> <small>CARGADAS</small></span>
										 </li>
										 <li>
											  LA SEMANA PASADA
											  <span class="pull-right"><b>26 582</b> <small>CARGADAS</small></span>
										 </li>
									</ul>
							  </div>
						 </div>
					</div>
					<!-- #END# Visitors -->
					<!-- Latest Social Trends -->
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						 <div class="card">
							  <div class="body bg-cyan">
									<div class="m-b--35 font-bold">ULTIMOS CLIENTES</div>
									<ul class="dashboard-stat-list">
										 <li>
											  #socialtrends
											  <span class="pull-right">
													<i class="material-icons">trending_up</i>
											  </span>
										 </li>
										 <li>
											  #materialdesign
											  <span class="pull-right">
													<i class="material-icons">trending_up</i>
											  </span>
										 </li>
										 <li>#adminbsb</li>
										 <li>#freeadmintemplate</li>
										 <li>#bootstraptemplate</li>
										 <li>
											  #freehtmltemplate
											  <span class="pull-right">
													<i class="material-icons">trending_up</i>
											  </span>
										 </li>
									</ul>
							  </div>
						 </div>
					</div>
					<!-- #END# Latest Social Trends -->
					<!-- Answered Tickets -->
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						 <div class="card">
							  <div class="body bg-teal">
									<div class="font-bold m-b--35">COTIZACIONES</div>
									<ul class="dashboard-stat-list">
										 <li>
											  HOY
											  <span class="pull-right"><b>12</b> <small>FACTURADO</small></span>
										 </li>
										 <li>
											  AYER
											  <span class="pull-right"><b>15</b> <small>FACTURADO</small></span>
										 </li>
										 <li>
											  LA SEMANA PASADA
											  <span class="pull-right"><b>90</b> <small>FACTURADO</small></span>
										 </li>
										 <li>
											  EL MES PASADO
											  <span class="pull-right"><b>342</b> <small>FACTURADO</small></span>
										 </li>
										 <li>
											  ULTIMO AÑO
											  <span class="pull-right"><b>4 225</b> <small>FACTURADO</small></span>
										 </li>
										 <li>
											  TODO
											  <span class="pull-right"><b>8 752</b> <small>FACTURADO</small></span>
										 </li>
									</ul>
							  </div>
						 </div>
					</div>
					<!-- #END# Answered Tickets -->
			  </div>

			  <div class="row clearfix">
					<!-- Task Info -->
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						 <div class="card">
							  <div class="header">
									<h2>COTIZACIONES ACTUALES</h2>
									<ul class="header-dropdown m-r--5">
										 <li class="dropdown">
											  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
													<i class="material-icons">more_vert</i>
											  </a>
											  <ul class="dropdown-menu pull-right">
													<li><a href="javascript:void(0);">Action</a></li>
													<li><a href="javascript:void(0);">Another action</a></li>
													<li><a href="javascript:void(0);">Something else here</a></li>
											  </ul>
										 </li>
									</ul>
							  </div>
							  <div class="body">
									<div class="table-responsive">
										 <table class="table table-hover dashboard-task-infos">
											  <thead>
													<tr>
														 <th>#</th>
														 <th>Cliente</th>
														 <th>Estado</th>
														 <th>Responsable</th>
														 <th>Progreso</th>
													</tr>
											  </thead>
											  <tbody>
													<tr>
														 <td>1</td>
														 <td>Task A</td>
														 <td><span class="label bg-green">Doing</span></td>
														 <td>John Doe</td>
														 <td>
															  <div class="progress">
																	<div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
															  </div>
														 </td>
													</tr>
													<tr>
														 <td>2</td>
														 <td>Task B</td>
														 <td><span class="label bg-blue">To Do</span></td>
														 <td>John Doe</td>
														 <td>
															  <div class="progress">
																	<div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
															  </div>
														 </td>
													</tr>
													<tr>
														 <td>3</td>
														 <td>Task C</td>
														 <td><span class="label bg-light-blue">On Hold</span></td>
														 <td>John Doe</td>
														 <td>
															  <div class="progress">
																	<div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
															  </div>
														 </td>
													</tr>
													<tr>
														 <td>4</td>
														 <td>Task D</td>
														 <td><span class="label bg-orange">Wait Approvel</span></td>
														 <td>John Doe</td>
														 <td>
															  <div class="progress">
																	<div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
															  </div>
														 </td>
													</tr>
													<tr>
														 <td>5</td>
														 <td>Task E</td>
														 <td>
															  <span class="label bg-red">Suspended</span>
														 </td>
														 <td>John Doe</td>
														 <td>
															  <div class="progress">
																	<div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
															  </div>
														 </td>
													</tr>
											  </tbody>
										 </table>
									</div>
							  </div>
						 </div>
					</div>
					<!-- #END# Task Info -->
					<!-- Browser Usage -->
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						 <div class="card">
							  <div class="header">
									<h2>OPORT. - COTIZ.</h2>
									<ul class="header-dropdown m-r--5">
										 <li class="dropdown">
											  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
													<i class="material-icons">more_vert</i>
											  </a>
											  <ul class="dropdown-menu pull-right">
													<li><a href="javascript:void(0);">Action</a></li>
													<li><a href="javascript:void(0);">Another action</a></li>
													<li><a href="javascript:void(0);">Something else here</a></li>
											  </ul>
										 </li>
									</ul>
							  </div>
							  <div class="body">
									<div id="donut_chart" class="dashboard-donut-chart"></div>
							  </div>
						 </div>
					</div>
					<!-- #END# Browser Usage -->
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

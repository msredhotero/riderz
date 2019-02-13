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


$resTrimestres = $serviciosReferencias->traerMeses();
$resTrimestreActual = $serviciosReferencias->traerMesesPorMes(date('m'));

//($campos,$idestado='', $idtipofactura='', $idcliente='', $idmes='', $anio='', $fecha='',$limit='')
$campos = 'f.concepto, f.total, f.fechaingreso, est.estado';
$idtipofactura = 1;
$idcliente = $_SESSION['idcliente'];
$limit = 'limit 10';
$resIngresos = $serviciosReferencias->traerFacturasPorGeneral($campos,$idestado='', $idtipofactura, $idcliente, $idmes='', $anio='', $fecha='',$limit);

//die(var_dump($resIngresos));

$campos = 'f.concepto, f.total, f.fechaingreso, est.estado';
$idtipofactura = 2;
$idcliente = $_SESSION['idcliente'];
$limit = 'limit 10';
$resGastos = $serviciosReferencias->traerFacturasPorGeneral($campos,$idestado='', $idtipofactura, $idcliente, $idmes='', $anio='', $fecha='',$limit);


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

	 <!-- CSS file -->
	<link rel="stylesheet" href="../css/easy-autocomplete.min.css">

	<!-- Additional CSS Themes file - not required-->
	<link rel="stylesheet" href="../css/easy-autocomplete.themes.min.css">



	 <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

	 <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

	 <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

	 <link rel="stylesheet" href="../DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css">
 	<link rel="stylesheet" href="../DataTables/DataTables-1.10.18/css/dataTables.bootstrap.css">
 	<link rel="stylesheet" href="../DataTables/DataTables-1.10.18/css/dataTables.jqueryui.min.css">
 	<link rel="stylesheet" href="../DataTables/DataTables-1.10.18/css/jquery.dataTables.css">

    <style>
        .alert > i{ vertical-align: middle !important; }
    </style>

</head>

<body class="theme-purple">

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

    <section class="content" style="margin-top:-35px;">

		<div class="container-fluid">
			<!-- Widgets -->
			<div class="row clearfix">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php if ($_SESSION['idroll_sahilices'] == 1) { ?>

						<?php } else { ?>


						<?php } ?>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="info-box bg-green hover-expand-effect">
							<div class="icon">
								<i class="material-icons">euro_symbol</i>
							</div>
							<div class="content">
								<div class="text">INGRESOS</div>
								<div class="number">$ 3.684.984</div>
							</div>
						</div>
					</div>


					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="info-box bg-orange hover-expand-effect">
							<div class="icon">
								<i class="material-icons">assignment_returned</i>
							</div>
							<div class="content">
								<div class="text">GASTOS</div>
								<div class="number">$ -1.684.984</div>
							</div>
						</div>
					</div>

					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="card">
                        <div class="header bg-pink">
                           <h2>
                              <?php echo mysql_result($resTrimestreActual,0,'meses'); ?> del <?php echo date('Y'); ?> <small>Últimas Facturas de Ingresos</small>
                           </h2>

                        </div>
                        <div class="body">
									<table id="example1" class="display table " style="width:100%">
										<thead>
											<tr>
												<th>Concepto</th>
												<th>Importe Total</th>
												<th>Fecha</th>
												<th>Estado</th>
											</tr>
										</thead>
										<tbody>
										<?php while ($row = mysql_fetch_array($resIngresos)) { ?>
											<tr>
												<th><?php echo $row['concepto']; ?></th>
												<th><?php echo $row['total']; ?></th>
												<th><?php echo $row['fechaingreso']; ?></th>
												<th><?php echo $row['estado']; ?></th>
											</tr>
										<?php } ?>
										</tbody>
									</table>
                        </div>
                  </div>
               </div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="card">
                        <div class="header bg-pink">
                           <h2>
                              <?php echo mysql_result($resTrimestreActual,0,'meses'); ?> del <?php echo date('Y'); ?> <small>Últimas Facturas de Gastos</small>
                           </h2>

                        </div>
                        <div class="body">
									<table id="example2" class="display table " style="width:100%">
										<thead>
											<tr>
												<th>Concepto</th>
												<th>Importe Total</th>
												<th>Fecha</th>
												<th>Estado</th>
											</tr>
										</thead>
										<tbody>
										<?php while ($row2 = mysql_fetch_array($resGastos)) { ?>
											<tr>
												<th><?php echo $row2['concepto']; ?></th>
												<th><?php echo $row2['total']; ?></th>
												<th><?php echo $row2['fechaingreso']; ?></th>
												<th><?php echo $row2['estado']; ?></th>
											</tr>
										<?php } ?>
										</tbody>
									</table>
                        </div>
                  </div>
               </div>

				</div>


			</div>
		</div>


    </section>


    <?php echo $baseHTML->cargarArchivosJS('../'); ?>

	 <script src="../js/jquery.easy-autocomplete.min.js"></script>

	 <script src="../DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>



	<script>
		$(document).ready(function(){


		});
	</script>



</body>
<?php } ?>
</html>

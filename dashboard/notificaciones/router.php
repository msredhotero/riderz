<?php

session_start();

if (!isset($_SESSION['usua_sahilices']))
{
	header('Location: ../../error.php');
} else {


   include ('../../includes/funciones.php');
   include ('../../includes/funcionesUsuarios.php');
   include ('../../includes/funcionesHTML.php');
   include ('../../includes/funcionesReferencias.php');
   include ('../../includes/base.php');
   include ('../../includes/funcionesNotificaciones.php');

   $serviciosFunciones 	= new Servicios();
   $serviciosUsuario 		= new ServiciosUsuarios();
   $serviciosHTML 			= new ServiciosHTML();
   $serviciosReferencias 	= new ServiciosReferencias();
   $serviciosNotificaciones	= new ServiciosNotificaciones();

   $id = $_GET['id'];

   $resMarcar = $serviciosNotificaciones->marcarNotificacion($id);

   $resNotificacion = $serviciosNotificaciones->traerNotificacionesPorId($id);

   $url = mysql_result($resNotificacion,0,'url');

   $id1 = mysql_result($resNotificacion,0,'id1');

   header('Location: ../'.$url.$id1);



}

?>

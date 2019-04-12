<?php

session_start();

$servidorCarpeta = 'riderz.git/trunk';

if (!isset($_SESSION['usua_sahilices']))
{
	header('Location: ../../error.php');
} else {

    include ('../../includes/funciones.php');
    include ('../../includes/funcionesUsuarios.php');
    include ('../../includes/funcionesHTML.php');
    include ('../../includes/funcionesReferencias.php');
    include ('../../includes/base.php');


	 include '../../includes/ImageResize.php';
	 include '../../includes/ImageResizeException.php';



    $serviciosFunciones 	= new Servicios();
    $serviciosUsuario 		= new ServiciosUsuarios();
    $serviciosHTML 			= new ServiciosHTML();
    $serviciosReferencias 	= new ServiciosReferencias();

    $archivo = $_FILES['file'];

    $templocation = $archivo['tmp_name'];

    $name = $serviciosReferencias->sanear_string(str_replace(' ','',basename($archivo['name'])));


    if (!$templocation) {
        die('No ha seleccionado ningun archivo');
    }

	 $noentrar = '../../imagenes/index.php';


	 $imagen = $serviciosReferencias->sanear_string(basename($archivo['name']));
	 $type = $archivo["type"];



	$resDocumentacionImagen = $serviciosReferencias->insertarSubidas($_POST['idcliente'],$imagen,$type);
   //$dir_destino = '../../../../'.$servidorCarpeta.'/subidas/'.$resDocumentacionImagen.'/';
   //echo $dir_destino;
   //insertarDocumentacionjugadorimagenes($_POST['iddocumentacion'],0,$imagen,$type,1,$_POST['idcliente']);


	 //$iddocumentacionjugadorimagen = $resDocumentacionImagen;

	 // desarrollo
	 $dir_destino = '../../../../'.$servidorCarpeta.'/subidas/'.$resDocumentacionImagen.'/';

	 // produccion
	 //$dir_destino = 'https://www.saupureinconsulting.com.ar/aifzn/data/'.mysql_result($resFoto,0,'iddocumentacionjugadorimagen').'/';

	 $imagen_subida = $dir_destino.$name;

	 // desarrollo
	 $nuevo_noentrar = $dir_destino.'index.php';

	 // produccion
	 // $nuevo_noentrar = 'https://www.saupureinconsulting.com.ar/aifzn/data/'.$_SESSION['idclub_aif'].'/'.'index.php';


    if (!file_exists($dir_destino)) {
        mkdir($dir_destino, 0777);
    }



	if (move_uploaded_file($templocation, $imagen_subida)) {
		copy($noentrar, $nuevo_noentrar);
      $pos = strpos( strtolower($type), 'application');
	   if ($pos === false) {
   		$image = new \Gumlet\ImageResize($imagen_subida);
   		$image->scale(50);
   		$image->save($imagen_subida);
      }



		echo "Archivo guardado correctamente";
	} else {
		echo "Error al guardar el archivo ";
      $serviciosReferencias->eliminarSubidas($resDocumentacionImagen);
	}



}

?>

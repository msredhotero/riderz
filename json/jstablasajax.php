<?php


include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');
include ('../includes/funcionesUsuarios.php');

$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();
$serviciosUsuarios  		= new ServiciosUsuarios();

$tabla = $_GET['tabla'];
$draw = $_GET['sEcho'];
$start = $_GET['iDisplayStart'];
$length = $_GET['iDisplayLength'];
$busqueda = $_GET['sSearch'];

$idcliente = 0;
if (isset($_GET['idcliente'])) {
	$idcliente = $_GET['idcliente'];
} else {
	$idcliente = 0;
}


$referencia1 = 0;

if (isset($_GET['referencia1'])) {
	$referencia1 = $_GET['referencia1'];
} else {
	$referencia1 = 0;
}

function armarAcciones($id,$label='',$class,$icon) {
	$cad = "";

	for ($j=0; $j<count($class); $j++) {
		$cad .= '<button type="button" class="btn '.$class[$j].' btn-circle waves-effect waves-circle waves-float '.$label[$j].'" id="'.$id.'">
				<i class="material-icons">'.$icon[$j].'</i>
			</button> ';
	}

	return $cad;
}

switch ($tabla) {
	case 'facturas':
		$resAjax = $serviciosReferencias->traerFacturasPorClienteajax($idcliente,$length, $start, $busqueda);
		$res = $serviciosReferencias->traerFacturasPorCliente($idcliente);
		$label = array('btnDescargar');
		$class = array('bg-green');
		$icon = array('file_download');
		$indiceID = 0;
		$empieza = 1;
		$termina = 9;

		break;
	case 'facturastodas':
		$resAjax = $serviciosReferencias->traerFacturasajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerFacturas();
		$label = array('btnDescargar','btnModificar');
		$class = array('bg-green','bg-orange');
		$icon = array('file_download','edit');
		$indiceID = 0;
		$empieza = 1;
		$termina = 10;

		break;
	case 'clientes':
		$resAjax = $serviciosReferencias->traerClientesajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerClientes();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 10;

		break;
	case 'usuarios':
		$resAjax = $serviciosUsuarios->traerUsuariosajax($length, $start, $busqueda);
		$res = $serviciosUsuarios->traerUsuarios();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 5;

		break;

	default:
		// code...
		break;
}


$cantidadFilas = mysql_num_rows($res);


header("content-type: Access-Control-Allow-Origin: *");

$ar = array();
$arAux = array();
$cad = '';
$id = 0;
	while ($row = mysql_fetch_array($resAjax)) {
		//$id = $row[$indiceID];

		for ($i=$empieza;$i<=$termina;$i++) {
			array_push($arAux, $row[$i]);
		}

		array_push($arAux, armarAcciones($row[0],$label,$class,$icon));

		array_push($ar, $arAux);

		$arAux = array();
		//die(var_dump($ar));
	}

$cad = substr($cad, 0, -1);

$data = '{ "sEcho" : '.$draw.', "iTotalRecords" : '.$cantidadFilas.', "iTotalDisplayRecords" : 10, "aaData" : ['.$cad.']}';

//echo "[".substr($cad,0,-1)."]";
echo json_encode(array(
			"draw"            => $draw,
			"recordsTotal"    => $cantidadFilas,
			"recordsFiltered" => $cantidadFilas,
			"data"            => $ar
		));

?>

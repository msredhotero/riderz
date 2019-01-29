<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {



	/* PARA Oportunidades */

	function insertarOportunidades($empresa,$contacto,$telefono,$email,$comentarios,$reftipostrabajos,$refmotivosoportunidades,$observaciones,$refusuarios,$refestados,$refcotizaciones,$refsemaforos,$refestadocotizacion) {
		$sql = "insert into dboportunidades(idoportunidad,empresa,contacto,telefono,email,comentarios,reftipostrabajos,refmotivosoportunidades,observaciones,refusuarios,refestados,refestadocotizacion,refcotizaciones,refsemaforos)
		values ('','".$empresa."','".$contacto."','".$telefono."','".$email."','".$comentarios."',".$reftipostrabajos.",".$refmotivosoportunidades.",'".$observaciones."',".$refusuarios.",".$refestados.",".$refestadocotizacion.",".$refcotizaciones.",".$refsemaforos.")";
		$res = $this->query($sql,1);
		return $res;
	}


	function modificarOportunidades($id,$empresa,$contacto,$telefono,$email,$comentarios,$reftipostrabajos,$refmotivosoportunidades,$observaciones,$refusuarios,$refestados,$refcotizaciones,$refsemaforos,$refestadocotizacion) {
		$sql = "update dboportunidades
		set
		empresa = '".$empresa."',contacto = '".$contacto."',telefono = '".$telefono."',email = '".$email."',comentarios = '".$comentarios."',reftipostrabajos = ".$reftipostrabajos.",refmotivosoportunidades = ".$refmotivosoportunidades.",observaciones = '".$observaciones."',refusuarios = ".$refusuarios.",refestados = ".$refestados.",refestadocotizacion = ".$refestadocotizacion.",refcotizaciones = ".$refcotizaciones.",refsemaforos = ".$refsemaforos."
		where idoportunidad =".$id;
		$res = $this->query($sql,0);
		return $res;
	}

	function modificarEstadoOportunidad($idoportunidad, $idestado) {
		$sql = "update dboportunidades
					set refestados = ".$idestado."
					where idoportunidad = ".$idoportunidad;

		$res = $this->query($sql,0);
		return $res;
	}


	function modificarSemaforoOportunidad($idoportunidad, $idsemaforo) {
		$sql = "update dboportunidades
					set refsemaforos = ".$idsemaforo."
					where idoportunidad = ".$idoportunidad;

		$res = $this->query($sql,0);
		return $res;
	}


	function eliminarOportunidades($id) {
		$sql = "delete from dboportunidades where idoportunidad =".$id;
		$res = $this->query($sql,0);
		return $res;
	}

	function traerOportunidadesajax($length, $start, $busqueda) {

		$where = '';

		$busqueda = str_replace("'","",$busqueda);
		if ($busqueda != '') {
			$where = "where o.empresa like '%".$busqueda."%' or o.contacto like '%".$busqueda."%' or o.telefono like '%".$busqueda."%' or o.email like '%".$busqueda."%' or tip.tipotrabajo like '%".$busqueda."%' or mot.motivo like '%".$busqueda."%' or est.estado like '%".$busqueda."%'";
		}

		$sql = "select
			o.idoportunidad,
			o.empresa,
			o.contacto,
			o.telefono,
			o.email,
			tip.tipotrabajo,
			mot.motivo,
			o.comentarios,
			est.estado,
			ec.estadocotizacion,
			usu.nombrecompleto,
			o.fechacreacion,
			sem.color as semaforo,
			est.color,
			o.reftipostrabajos,
			o.refmotivosoportunidades,
			o.observaciones,
			o.refusuarios,
			o.refestados,
			o.refestadocotizacion,
			o.refcotizaciones,
			o.refsemaforos
		from dboportunidades o
		inner join tbtipostrabajos tip ON tip.idtipotrabajo = o.reftipostrabajos
		inner join tbmotivosoportunidades mot ON mot.idmotivooportunidad = o.refmotivosoportunidades
		inner join tbestados est ON est.idestado = o.refestados
		inner join tbestadocotizacion ec ON ec.idestadocotizacion = o.refestadocotizacion
		inner join dbusuarios usu ON usu.idusuario = o.refusuarios
		inner join tbsemaforos sem ON sem.idsemaforo = o.refsemaforos
		".$where."
		order by o.fechacreacion desc
		limit ".$start.",".$length;
		$res = $this->query($sql,0);
		return $res;
	}

	function traerOportunidades() {
		$sql = "select
			o.idoportunidad,
			o.empresa,
			o.contacto,
			o.telefono,
			o.email,
			tip.tipotrabajo,
			mot.motivo,
			o.comentarios,
			est.estado,
			ec.estadocotizacion,
			sem.color as semaforo,
			est.color,
			o.reftipostrabajos,
			o.refmotivosoportunidades,
			o.observaciones,
			o.refusuarios,
			o.refestados,
			o.refestadocotizacion,
			o.refcotizaciones,
			o.refsemaforos,
			o.fechacreacion
		from dboportunidades o
		inner join tbtipostrabajos tip ON tip.idtipotrabajo = o.reftipostrabajos
		inner join tbmotivosoportunidades mot ON mot.idmotivooportunidad = o.refmotivosoportunidades
		inner join tbestados est ON est.idestado = o.refestados
		inner join tbestadocotizacion ec ON ec.idestadocotizacion = o.refestadocotizacion
		inner join dbusuarios usu ON usu.idusuario = o.refusuarios
		inner join tbsemaforos sem ON sem.idsemaforo = o.refsemaforos
		order by o.fechacreacion desc";
		$res = $this->query($sql,0);
		return $res;
	}

	function traerOportunidadesActivas() {
		$sql = "select
			o.idoportunidad,
			o.empresa,
			o.contacto,
			o.telefono,
			o.email,
			tip.tipotrabajo,
			mot.motivo,
			o.comentarios,
			est.estado,
			ec.estadocotizacion,
			sem.color as semaforo,
			est.color,
			o.reftipostrabajos,
			o.refmotivosoportunidades,
			o.observaciones,
			o.refusuarios,
			o.refestados,
			o.refestadocotizacion,
			o.refcotizaciones,
			o.refsemaforos,
			o.fechacreacion,
			DATEDIFF(now(), o.fechacreacion) mora
		from dboportunidades o
		inner join tbtipostrabajos tip ON tip.idtipotrabajo = o.reftipostrabajos
		inner join tbmotivosoportunidades mot ON mot.idmotivooportunidad = o.refmotivosoportunidades
		inner join tbestados est ON est.idestado = o.refestados
		inner join dbusuarios usu ON usu.idusuario = o.refusuarios
		inner join tbestadocotizacion ec ON ec.idestadocotizacion = o.refestadocotizacion
		inner join tbsemaforos sem ON sem.idsemaforo = o.refsemaforos
		where o.refcotizaciones = 0
		order by o.fechacreacion desc";
		$res = $this->query($sql,0);
		return $res;
	}


	function traerOportunidadesPorId($id) {
		$sql = "select idoportunidad,empresa,contacto,telefono,email,comentarios,reftipostrabajos,refmotivosoportunidades,observaciones,refusuarios,refestados,refestadocotizacion,refcotizaciones,refsemaforos,fechacreacion from dboportunidades where idoportunidad =".$id;
		$res = $this->query($sql,0);
		return $res;
	}

/* Fin */
/* Fin de la Tabla: dboportunidades*/

	function GUID()
	{
		if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	function sanear_string($string)
	{

		$string = trim($string);

		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);

		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);

		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);

		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);

		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);

		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);



		return $string;
	}

	function borrarDirecctorio($dir) {
        array_map('unlink', glob($dir."/*.*"));

    }

	function borrarArchivos($directorio) {

        $res =  $this->borrarDirecctorio("./".$directorio);

        rmdir("./".$directorio);

        return '';
	}

	function existe($sql) {

	    $res = $this->query($sql,0);

	    if (mysql_num_rows($res)>0) {
	        return 1;
	    }
	    return 0;
	}

	function existeDevuelveId($sql) {

	    $res = $this->query($sql,0);

	    if (mysql_num_rows($res)>0) {
	        return mysql_result($res,0,0);
	    }
	    return 0;
	}


	function devolverIdEstado($tabla,$id, $idlbl) {
		$sql = "select refestados
				from ".$tabla."
				where ".$idlbl." = ".$id;

		$res = $this->existeDevuelveId($sql);
		return $res;
	}





	function insertarConfiguracion($razonsocial,$empresa,$sistema,$direccion,$telefono,$email) {
	$sql = "insert into tbconfiguracion(idconfiguracion,razonsocial,empresa,sistema,direccion,telefono,email)
	values ('','".($razonsocial)."','".($empresa)."','".($sistema)."','".($direccion)."','".($telefono)."','".($email)."')";
	$res = $this->query($sql,1);
	return $res;
	}


	function modificarConfiguracion($id,$razonsocial,$empresa,$sistema,$direccion,$telefono,$email) {
	$sql = "update tbconfiguracion
	set
	razonsocial = '".($razonsocial)."',empresa = '".($empresa)."',sistema = '".($sistema)."',direccion = '".($direccion)."',telefono = '".($telefono)."',email = '".($email)."'
	where idconfiguracion =".$id;
	$res = $this->query($sql,0);
	return $res;
	}


	function eliminarConfiguracion($id) {
	$sql = "delete from tbconfiguracion where idconfiguracion =".$id;
	$res = $this->query($sql,0);
	return $res;
	}


	function traerConfiguracion() {
	$sql = "select
	c.idconfiguracion,
	c.razonsocial,
	c.empresa,
	c.sistema,
	c.direccion,
	c.telefono,
	c.email
	from tbconfiguracion c
	order by 1";
	$res = $this->query($sql,0);
	return $res;
	}


	function traerConfiguracionPorId($id) {
	$sql = "select idconfiguracion,razonsocial,empresa,sistema,direccion,telefono,email from tbconfiguracion where idconfiguracion =".$id;
	$res = $this->query($sql,0);
	return $res;
	}

	/* Fin */
	/* /* Fin de la Tabla: tbconfiguracion*/






/* PARA Clientes */

function insertarClientes($razonsocial,$cuit,$direccion,$email,$telefono) {
$sql = "insert into dbclientes(idcliente,razonsocial,cuit,direccion,email,telefono)
values ('','".($razonsocial)."','".($cuit)."','".($direccion)."','".($email)."','".($telefono)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarClientes($id,$razonsocial,$cuit,$direccion,$email,$telefono) {
$sql = "update dbclientes
set
razonsocial = '".($razonsocial)."',cuit = '".($cuit)."',direccion = '".($direccion)."',email = '".($email)."',telefono = '".($telefono)."'
where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarClientes($id) {
$sql = "delete from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerClientesajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where c.razonsocial like '%".$busqueda."%' or c.cuit like '%".$busqueda."%' or c.direccion like '%".$busqueda."%' or c.email like '%".$busqueda."%' or c.telefono like '%".$busqueda."%'";
	}

	$sql = "select
	c.idcliente,
	c.razonsocial,
	c.cuit,
	c.direccion,
	c.email,
	c.telefono
	from dbclientes c
	".$where."
	order by c.razonsocial
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}


function traerClientes() {
$sql = "select
c.idcliente,
c.razonsocial,
c.cuit,
c.direccion,
c.email,
c.telefono
from dbclientes c
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClientesPorId($id) {
$sql = "select idcliente,razonsocial,cuit,direccion,email,telefono from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbclientes*/


/* PARA Conceptos */

function insertarConceptos($concepto,$abreviatura,$leyenda,$activo) {
$sql = "insert into dbconceptos(idconcepto,concepto,abreviatura,leyenda,activo)
values ('','".($concepto)."','".($abreviatura)."','".($leyenda)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarConceptos($id,$concepto,$abreviatura,$leyenda,$activo) {
$sql = "update dbconceptos
set
concepto = '".($concepto)."',abreviatura = '".($abreviatura)."',leyenda = '".($leyenda)."',activo = ".$activo."
where idconcepto =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarConceptos($id) {
$sql = "delete from dbconceptos where idconcepto =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerConceptosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where c.concepto like '%".$busqueda."%' or c.abreviatura like '%".$busqueda."%' or c.leyenda like '%".$busqueda."%' or (case when c.activo = 1 then 'Si' else 'No' end) = '".$busqueda."'";
	}

	$sql = "select
	c.idconcepto,
	c.concepto,
	c.abreviatura,
	c.leyenda,
	(case when c.activo = 1 then 'Si' else 'No' end) as activo
	from dbconceptos c
	".$where."
	order by c.concepto
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}

function traerConceptos() {
	$sql = "select
	c.idconcepto,
	c.concepto,
	c.abreviatura,
	c.leyenda,
	(case when c.activo = 1 then 'Si' else 'No' end) as activo
	from dbconceptos c
	order by 1";

	$res = $this->query($sql,0);
	return $res;
}


function traerConceptosPorId($id) {
$sql = "select idconcepto,concepto,abreviatura,leyenda,activo from dbconceptos where idconcepto =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbconceptos*/


/* PARA Conceptosviaticos */

function insertarConceptosviaticos($refconceptos,$valor,$formula) {
$sql = "insert into dbconceptosviaticos(idconceptoviatico,refconceptos,valor,formula)
values ('',".$refconceptos.",".$valor.",'".($formula)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarConceptosviaticos($id,$refconceptos,$valor,$formula) {
$sql = "update dbconceptosviaticos
set
refconceptos = ".$refconceptos.",valor = ".$valor.",formula = '".($formula)."'
where idconceptoviatico =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarConceptosviaticos($id) {
$sql = "delete from dbconceptosviaticos where idconceptoviatico =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerConceptosviaticos() {
$sql = "select
c.idconceptoviatico,
c.refconceptos,
c.valor,
c.formula
from dbconceptosviaticos c
inner join dbconceptos con ON con.idconcepto = c.refconceptos
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerConceptosviaticosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where con.concepto like '%".$busqueda."%' or c.formula like '%".$busqueda."%'";
	}

	$sql = "select
	c.idconceptoviatico,
	con.concepto,
	c.valor,
	c.formula,
	c.refconceptos
	from dbconceptosviaticos c
	inner join dbconceptos con ON con.idconcepto = c.refconceptos
	".$where."
	order by con.concepto
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}


function traerConceptosviaticosPorId($id) {
$sql = "select idconceptoviatico,refconceptos,valor,formula from dbconceptosviaticos where idconceptoviatico =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbconceptosviaticos*/


/* PARA Contactos */

function insertarContactos($refsectores,$apellido,$nombre,$nrodocumento,$email,$telefono) {
$sql = "insert into dbcontactos(idcontacto,refsectores,apellido,nombre,nrodocumento,email,telefono)
values ('',".$refsectores.",'".($apellido)."','".($nombre)."',".$nrodocumento.",'".($email)."','".($telefono)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarContactos($id,$refsectores,$apellido,$nombre,$nrodocumento,$email,$telefono) {
$sql = "update dbcontactos
set
refsectores = ".$refsectores.",apellido = '".($apellido)."',nombre = '".($nombre)."',nrodocumento = ".$nrodocumento.",email = '".($email)."',telefono = '".($telefono)."'
where idcontacto =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarContactos($id) {
$sql = "delete from dbcontactos where idcontacto =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerContactos() {
$sql = "select
c.idcontacto,
c.refsectores,
c.apellido,
c.nombre,
c.nrodocumento,
c.email,
c.telefono
from dbcontactos c
inner join dbsectores sec ON sec.idsector = c.refsectores
inner join dbplantas pl ON pl.idplanta = sec.refplantas
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerContactosPorCliente($idcliente) {
$sql = "select
c.idcontacto,
c.refsectores,
c.apellido,
c.nombre,
c.nrodocumento,
c.email,
c.telefono
from dbcontactos c
inner join dbsectores sec ON sec.idsector = c.refsectores
inner join dbplantas pl ON pl.idplanta = sec.refplantas
where pl.refclientes = ".$idcliente."
order by c.apellido, c.nombre";
$res = $this->query($sql,0);
return $res;
}



function traerContactosajaxPorCliente($length, $start, $busqueda, $idcliente) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "and pl.planta like '%".$busqueda."%' or sec.sector like '%".$busqueda."%' or c.apellido like '%".$busqueda."%' or c.nombre like '%".$busqueda."%' or c.nrodocumento like '%".$busqueda."%' or c.email like '%".$busqueda."%' or c.telefono like '%".$busqueda."%'";
	}

	$sql = "select
	c.idcontacto,
	pl.planta,
	sec.sector,
	c.apellido,
	c.nombre,
	c.nrodocumento,
	c.email,
	c.telefono,
	c.refsectores
	from dbcontactos c
	inner join dbsectores sec ON sec.idsector = c.refsectores
	inner join dbplantas pl ON pl.idplanta = sec.refplantas
	where pl.refclientes = ".$idcliente." ".$where."
	order by c.apellido, c.nombre
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}


function traerContactosPorId($id) {
$sql = "select idcontacto,refsectores,apellido,nombre,nrodocumento,email,telefono from dbcontactos where idcontacto =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* Fin de la Tabla: dbcontactos*/


/* PARA Empleados */

function existeEmpleado($nroDocumento) {
    $sql = "select idempleado from dbempleados where nrodocumento = ".$nroDocumento;
    $res = $this->query($sql,0);

    if (mysql_num_rows($res)>0) {
        return 1;
    }
    return 0;
}

function existeEmpleadoModificar($nroDocumento, $id) {
    $sql = "select idempleado from dbempleados where nrodocumento = ".$nroDocumento." and idempleado <> ".$id;
    $res = $this->query($sql,0);

    if (mysql_num_rows($res)>0) {
        return 1;
    }
    return 0;
}

function insertarEmpleados($apellido,$nombre,$nrodocumento,$cuit,$fechanacimiento,$domicilio,$telefonofijo,$telefonomovil,$sexo,$email,$activo) {
$sql = "insert into dbempleados(idempleado,apellido,nombre,nrodocumento,cuit,fechanacimiento,domicilio,telefonofijo,telefonomovil,sexo,email,activo)
values ('','".($apellido)."','".($nombre)."',".$nrodocumento.",'".($cuit)."','".($fechanacimiento)."','".($domicilio)."','".($telefonofijo)."','".($telefonomovil)."','".($sexo)."','".($email)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarEmpleados($id,$apellido,$nombre,$nrodocumento,$cuit,$fechanacimiento,$domicilio,$telefonofijo,$telefonomovil,$sexo,$email,$activo) {
$sql = "update dbempleados
set
apellido = '".($apellido)."',nombre = '".($nombre)."',nrodocumento = ".$nrodocumento.",cuit = '".($cuit)."',fechanacimiento = '".($fechanacimiento)."',domicilio = '".($domicilio)."',telefonofijo = '".($telefonofijo)."',telefonomovil = '".($telefonomovil)."',sexo = '".($sexo)."',email = '".($email)."',activo = ".$activo." where idempleado =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarEmpleados($id) {
$sql = "delete from dbempleados where idempleado =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerEmpleadosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where e.apellido like '%".$busqueda."%' or e.nombre like '%".$busqueda."%' or e.nrodocumento like '%".$busqueda."%' or e.cuit like '%".$busqueda."%' or e.fechanacimiento like '%".$busqueda."%' or e.telefonomovil like '%".$busqueda."%' or e.email like '%".$busqueda."%' or (case when e.activo = 1 then 'Si' else 'No' end) = '".$busqueda."'";
	}

	$sql = "select
	e.idempleado,
	e.apellido,
	e.nombre,
	e.nrodocumento,
	e.cuit,
	e.fechanacimiento,
	e.telefonomovil,
	e.email,
	(case when e.activo = 1 then 'Si' else 'No' end) as activo
	from dbempleados e
	".$where."
	order by e.apellido, e.nombre
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}


function traerEmpleados() {
$sql = "select
e.idempleado,
e.apellido,
e.nombre,
e.nrodocumento,
e.cuit,
e.fechanacimiento,
e.telefonomovil,
e.email,
(case when e.activo = 1 then 'Si' else 'No' end) as activo
from dbempleados e
order by e.apellido, e.nombre";
$res = $this->query($sql,0);
return $res;
}


function traerEmpleadosPorId($id) {
$sql = "select idempleado,apellido,nombre,nrodocumento,cuit,fechanacimiento,domicilio,telefonofijo,telefonomovil,sexo,email,activo from dbempleados where idempleado =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbempleados*/


/* PARA Listasprecios */

function insertarListasprecios($nombre,$refconceptos,$precio1,$precio2,$precio3,$precio4,$iva,$vigenciadesde,$vigenciahasta) {
$sql = "insert into dblistasprecios(idlistaprecio,nombre,refconceptos,precio1,precio2,precio3,precio4,iva,vigenciadesde,vigenciahasta)
values ('','".($nombre)."',".$refconceptos.",".$precio1.",".$precio2.",".$precio3.",".$precio4.",".$iva.",'".($vigenciadesde)."','".($vigenciahasta)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarListasprecios($id,$nombre,$refconceptos,$precio1,$precio2,$precio3,$precio4,$iva,$vigenciadesde,$vigenciahasta) {
$sql = "update dblistasprecios
set
nombre = '".($nombre)."',refconceptos = ".$refconceptos.",precio1 = ".$precio1.",precio2 = ".$precio2.",precio3 = ".$precio3.",precio4 = ".$precio4.",iva = ".$iva.",vigenciadesde = '".($vigenciadesde)."',vigenciahasta = '".($vigenciahasta)."'
where idlistaprecio =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarListasprecios($id) {
$sql = "delete from dblistasprecios where idlistaprecio =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerListaspreciosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where l.nombre like '%".$busqueda."%' and con.concepto like '%".$busqueda."%' and l.precio1 like '%".$busqueda."%' and l.precio2 like '%".$busqueda."%' and l.precio3 like '%".$busqueda."%' and l.precio4 like '%".$busqueda."%'";
	}

	$sql = "select
	l.idlistaprecio,
	l.nombre,
	con.concepto,
	l.precio1,
	l.precio2,
	l.precio3,
	l.precio4,
	l.iva,
	l.vigenciadesde,
	l.vigenciahasta
	from dblistasprecios l
	inner join dbconceptos con ON con.idconcepto = l.refconceptos
	".$where."
	order by l.nombre
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}

function traerListasprecios() {
$sql = "select
l.idlistaprecio,
l.nombre,
con.concepto,
l.precio1,
l.precio2,
l.precio3,
l.precio4,
l.iva,
l.vigenciadesde,
l.vigenciahasta,
l.refconceptos
from dblistasprecios l
inner join dbconceptos con ON con.idconcepto = l.refconceptos
order by l.nombre";
$res = $this->query($sql,0);
return $res;
}


function traerListaspreciosPorId($id) {
$sql = "select idlistaprecio,nombre,refconceptos,precio1,precio2,precio3,precio4,iva,vigenciadesde,vigenciahasta from dblistasprecios where idlistaprecio =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dblistasprecios*/


/* PARA Plantas */

function insertarPlantas($refclientes,$planta) {
$sql = "insert into dbplantas(idplanta,refclientes,planta)
values ('',".$refclientes.",'".($planta)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPlantas($id,$refclientes,$planta) {
$sql = "update dbplantas
set
refclientes = ".$refclientes.",planta = '".($planta)."'
where idplanta =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPlantas($id) {
$sql = "delete from dbplantas where idplanta =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPlantas() {
$sql = "select
p.idplanta,
p.refclientes,
p.planta
from dbplantas p
inner join dbclientes cli ON cli.idcliente = p.refclientes
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPlantasPorCliente($idcliente) {
$sql = "select
p.idplanta,
p.refclientes,
p.planta
from dbplantas p
inner join dbclientes cli ON cli.idcliente = p.refclientes
where p.refclientes = ".$idcliente."
order by p.planta";
$res = $this->query($sql,0);
return $res;
}


function traerPlantasajaxPorCliente($length, $start, $busqueda, $idcliente) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "and p.planta like '%".$busqueda."%'";
	}

	$sql = "select
	p.idplanta,
	p.planta
	from dbplantas p
	inner join dbclientes cli ON cli.idcliente = p.refclientes
	where p.refclientes = ".$idcliente." ".$where."
	order by p.planta
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}


function traerPlantasPorId($id) {
$sql = "select idplanta,refclientes,planta from dbplantas where idplanta =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbplantas*/


/* PARA Sectores */

function insertarSectores($refplantas,$sector) {
$sql = "insert into dbsectores(idsector,refplantas,sector)
values ('',".$refplantas.",'".($sector)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarSectores($id,$refplantas,$sector) {
$sql = "update dbsectores
set
refplantas = ".$refplantas.",sector = '".($sector)."'
where idsector =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarSectores($id) {
$sql = "delete from dbsectores where idsector =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerSectores() {
$sql = "select
s.idsector,
s.refplantas,
s.sector
from dbsectores s
inner join dbplantas pla ON pla.idplanta = s.refplantas
inner join dbclientes cl ON cl.idcliente = pla.refclientes
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerSectoresPorCliente($idcliente) {
$sql = "select
s.idsector,
s.refplantas,
s.sector,
pla.planta
from dbsectores s
inner join dbplantas pla ON pla.idplanta = s.refplantas
inner join dbclientes cl ON cl.idcliente = pla.refclientes
where cl.idcliente = ".$idcliente."
order by pla.planta,s.sector";
$res = $this->query($sql,0);
return $res;
}


function traerSectoresajaxPorCliente($length, $start, $busqueda, $idcliente) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "and s.sector like '%".$busqueda."%' or s.planta like '%".$busqueda."%'";
	}

	$sql = "select
	s.idsector,
	pla.planta,
	s.sector,
	s.refplantas
	from dbsectores s
	inner join dbplantas pla ON pla.idplanta = s.refplantas
	inner join dbclientes cl ON cl.idcliente = pla.refclientes
	where cl.idcliente = ".$idcliente." ".$where."
	order by s.sector
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}


function traerSectoresPorId($id) {
$sql = "select idsector,refplantas,sector from dbsectores where idsector =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbsectores*/


/* PARA Estados */

function insertarEstados($estado,$color,$icono,$orden,$valor,$refformularios) {
$sql = "insert into tbestados(idestado,estado,color,icono,orden,valor,refformularios)
values ('','".($estado)."','".($color)."','".($icono)."',".$orden.",".$valor.",".$refformularios.")";
$res = $this->query($sql,1);
return $res;
}


function modificarEstados($id,$estado,$color,$icono,$orden,$valor,$refformularios) {
$sql = "update tbestados
set
estado = '".($estado)."',color = '".($color)."',icono = '".($icono)."',orden = ".$orden.",valor = ".$valor.",refformularios = ".$refformularios."
where idestado =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarEstados($id) {
$sql = "delete from tbestados where idestado =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerEstados() {
$sql = "select
e.idestado,
e.estado,
e.color,
e.icono,
e.orden,
e.valor,
e.refformularios
from tbestados e
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerEstadosPorId($id) {
$sql = "select idestado,estado,color,icono,orden,valor,refformularios from tbestados where idestado =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerEstadosInId($in) {
$sql = "select idestado,estado,color,icono,orden,valor,refformularios from tbestados where idestado in (".$in.")";
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbestados*/


/* PARA Formularios */

function insertarFormularios($formulario) {
$sql = "insert into tbformularios(idformulario,formulario)
values ('','".($formulario)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarFormularios($id,$formulario) {
$sql = "update tbformularios
set
formulario = '".($formulario)."'
where idformulario =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarFormularios($id) {
$sql = "delete from tbformularios where idformulario =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerFormularios() {
$sql = "select
f.idformulario,
f.formulario
from tbformularios f
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerFormulariosPorId($id) {
$sql = "select idformulario,formulario from tbformularios where idformulario =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbformularios*/


/* PARA Motivosoportunidades */

function insertarMotivosoportunidades($motivo,$activo) {
$sql = "insert into tbmotivosoportunidades(idmotivooportunidad,motivo,activo)
values ('','".($motivo)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarMotivosoportunidades($id,$motivo,$activo) {
$sql = "update tbmotivosoportunidades
set
motivo = '".($motivo)."',activo = ".$activo."
where idmotivooportunidad =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarMotivosoportunidades($id) {
$sql = "delete from tbmotivosoportunidades where idmotivooportunidad =".$id;
$res = $this->query($sql,0);
return $res;
}



function traerMotivosoportunidadesajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where m.motivo like '%".$busqueda."%' or (case when m.activo = 1 then 'Si' else 'No' end) = '".$busqueda."'";
	}

	$sql = "select
	m.idmotivooportunidad,
	m.motivo,
	(case when m.activo = 1 then 'Si' else 'No' end) activo
	from tbmotivosoportunidades m
	".$where."
	order by m.motivo
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}



function traerMotivosoportunidades() {
$sql = "select
m.idmotivooportunidad,
m.motivo,
(case when m.activo = 1 then 'Si' else 'No' end) activo
from tbmotivosoportunidades m
order by m.motivo";
$res = $this->query($sql,0);
return $res;
}


function traerMotivosoportunidadesPorId($id) {
$sql = "select idmotivooportunidad,motivo,activo from tbmotivosoportunidades where idmotivooportunidad =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbmotivosoportunidades*/


/* PARA Recursosnecesarios */

function insertarRecursosnecesarios($recursonecesario,$letra) {
$sql = "insert into tbrecursosnecesarios(idrecursonecesario,recursonecesario,letra)
values ('','".($recursonecesario)."','".($letra)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarRecursosnecesarios($id,$recursonecesario,$letra) {
$sql = "update tbrecursosnecesarios
set
recursonecesario = '".($recursonecesario)."',letra = '".($letra)."'
where idrecursonecesario =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarRecursosnecesarios($id) {
$sql = "delete from tbrecursosnecesarios where idrecursonecesario =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerRecursosnecesariosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where r.recursonecesario like '%".$busqueda."%' or r.letra = '%".$busqueda."%'";
	}

	$sql = "select
	r.idrecursonecesario,
	r.recursonecesario,
	r.letra
	from tbrecursosnecesarios r
	".$where."
	order by r.recursonecesario
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}

function traerRecursosnecesarios() {
$sql = "select
r.idrecursonecesario,
r.recursonecesario,
r.letra
from tbrecursosnecesarios r
order by r.recursonecesario";
$res = $this->query($sql,0);
return $res;
}


function traerRecursosnecesariosPorId($id) {
$sql = "select idrecursonecesario,recursonecesario,letra from tbrecursosnecesarios where idrecursonecesario =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbrecursosnecesarios*/


/* PARA Semaforos */

function insertarSemaforos($color,$desde,$hasta,$medida) {
$sql = "insert into tbsemaforos(idsemaforo,color,desde,hasta,medida)
values ('','".($color)."',".$desde.",".$hasta.",'".($medida)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarSemaforos($id,$color,$desde,$hasta,$medida) {
$sql = "update tbsemaforos
set
color = '".($color)."',desde = ".$desde.",hasta = ".$hasta.",medida = '".($medida)."'
where idsemaforo =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarSemaforos($id) {
$sql = "delete from tbsemaforos where idsemaforo =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerSemaforos() {
$sql = "select
s.idsemaforo,
s.color,
s.desde,
s.hasta,
s.medida
from tbsemaforos s
order by 1";
$res = $this->query($sql,0);
return $res;
}


function devolverSemaforosPorDias($dias) {
	$sql = "select
	s.idsemaforo,
	s.color,
	s.desde,
	s.hasta,
	s.medida
	from tbsemaforos s
	where ".$dias." between s.desde and s.hasta";
	$res = $this->query($sql,0);
	return mysql_result($res,0,0);
}


function traerSemaforosPorId($id) {
$sql = "select idsemaforo,color,desde,hasta,medida from tbsemaforos where idsemaforo =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerSemaforosPorIdDias($id) {
$sql = "select idsemaforo,color,desde, concat(hasta,' dias') as hasta,medida from tbsemaforos where idsemaforo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbsemaforos*/


/* PARA Tipoclientes */

function insertarTipoclientes($tipocliente) {
$sql = "insert into tbtipoclientes(idtipocliente,tipocliente)
values ('','".($tipocliente)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarTipoclientes($id,$tipocliente) {
$sql = "update tbtipoclientes
set
tipocliente = '".($tipocliente)."'
where idtipocliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipoclientes($id) {
$sql = "delete from tbtipoclientes where idtipocliente =".$id;
$res = $this->query($sql,0);
return $res;
}




function traerTipoclientesajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where t.tipocliente like '%".$busqueda."%'";
	}

	$sql = "select
	t.idtipocliente,
	t.tipocliente
	from tbtipoclientes t
	".$where."
	order by t.tipocliente
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}


function traerTipoclientes() {
$sql = "select
t.idtipocliente,
t.tipocliente
from tbtipoclientes t
order by t.tipocliente";
$res = $this->query($sql,0);
return $res;
}


function traerTipoclientesPorId($id) {
$sql = "select idtipocliente,tipocliente from tbtipoclientes where idtipocliente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbtipoclientes*/


/* PARA Estadocotizacion */

function insertarEstadocotizacion($estadocotizacion) {
$sql = "insert into tbestadocotizacion(idestadocotizacion,estadocotizacion)
values ('','".($estadocotizacion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarEstadocotizacion($id,$estadocotizacion) {
$sql = "update tbestadocotizacion
set
estadocotizacion = '".($estadocotizacion)."'
where idestadocotizacion =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarEstadocotizacion($id) {
$sql = "delete from tbestadocotizacion where idestadocotizacion =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerEstadocotizacion() {
$sql = "select
e.idestadocotizacion,
e.estadocotizacion
from tbestadocotizacion e
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerEstadocotizacionPorId($id) {
$sql = "select idestadocotizacion,estadocotizacion from tbestadocotizacion where idestadocotizacion =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbestadocotizacion*/

/* PARA Tipoconceptos */

function insertarTipoconceptos($tipoconcepto) {
$sql = "insert into tbtipoconceptos(idtipoconcepto,tipoconcepto)
values ('','".($tipoconcepto)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarTipoconceptos($id,$tipoconcepto) {
$sql = "update tbtipoconceptos
set
tipoconcepto = '".($tipoconcepto)."'
where idtipoconcepto =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipoconceptos($id) {
$sql = "delete from tbtipoconceptos where idtipoconcepto =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTipoconceptosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where t.tipoconcepto like '%".$busqueda."%'";
	}

	$sql = "select
	t.idtipoconcepto,
	t.tipoconcepto
	from tbtipoconceptos t
	".$where."
	order by t.tipoconcepto
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}


function traerTipoconceptos() {
$sql = "select
t.idtipoconcepto,
t.tipoconcepto
from tbtipoconceptos t
order by t.tipoconcepto";
$res = $this->query($sql,0);
return $res;
}


function traerTipoconceptosPorId($id) {
$sql = "select idtipoconcepto,tipoconcepto from tbtipoconceptos where idtipoconcepto =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbtipoconceptos*/


/* PARA Tipomonedas */

function insertarTipomonedas($tipomoneda,$abreviatura) {
$sql = "insert into tbtipomonedas(idtipomoneda,tipomoneda,abreviatura)
values ('','".($tipomoneda)."','".($abreviatura)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarTipomonedas($id,$tipomoneda,$abreviatura) {
$sql = "update tbtipomonedas
set
tipomoneda = '".($tipomoneda)."',abreviatura = '".($abreviatura)."'
where idtipomoneda =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipomonedas($id) {
$sql = "delete from tbtipomonedas where idtipomoneda =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTipomonedasajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where t.tipomoneda like '%".$busqueda."%' or t.abreviatura like '%".$busqueda."%'";
	}

	$sql = "select
	t.idtipomoneda,
	t.tipomoneda,
	t.abreviatura
	from tbtipomonedas t
	".$where."
	order by t.abreviatura
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}

function traerTipomonedas() {
$sql = "select
t.idtipomoneda,
t.tipomoneda,
t.abreviatura
from tbtipomonedas t
order by t.abreviatura";
$res = $this->query($sql,0);
return $res;
}


function traerTipomonedasPorId($id) {
$sql = "select idtipomoneda,tipomoneda,abreviatura from tbtipomonedas where idtipomoneda =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbtipomonedas*/


/* PARA Tipostrabajos */

function insertarTipostrabajos($tipotrabajo,$activo) {
$sql = "insert into tbtipostrabajos(idtipotrabajo,tipotrabajo,activo)
values ('','".($tipotrabajo)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarTipostrabajos($id,$tipotrabajo,$activo) {
$sql = "update tbtipostrabajos
set
tipotrabajo = '".($tipotrabajo)."',activo = ".$activo."
where idtipotrabajo =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipostrabajos($id) {
$sql = "delete from tbtipostrabajos where idtipotrabajo =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerTipostrabajosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where t.tipotrabajo like '%".$busqueda."%' or (case when t.activo = 1 then 'Si' else 'No' end) = '".$busqueda."'";
	}

	$sql = "select
	t.idtipotrabajo,
	t.tipotrabajo,
	(case when t.activo = 1 then 'Si' else 'No' end) activo
	from tbtipostrabajos t
	".$where."
	order by t.tipotrabajo
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}

function traerTipostrabajos() {
$sql = "select
t.idtipotrabajo,
t.tipotrabajo,
(case when t.activo = 1 then 'Si' else 'No' end) activo
from tbtipostrabajos t
order by t.tipotrabajo";
$res = $this->query($sql,0);
return $res;
}


function traerTipostrabajosPorId($id) {
$sql = "select idtipotrabajo,tipotrabajo,activo from tbtipostrabajos where idtipotrabajo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbtipostrabajos*/


/* PARA Unidadesnegocios */

function insertarUnidadesnegocios($unidadnegocio,$activo) {
$sql = "insert into tbunidadesnegocios(idunidadnegocio,unidadnegocio,activo)
values ('','".($unidadnegocio)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarUnidadesnegocios($id,$unidadnegocio,$activo) {
$sql = "update tbunidadesnegocios
set
unidadnegocio = '".($unidadnegocio)."',activo = ".$activo."
where idunidadnegocio =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarUnidadesnegocios($id) {
$sql = "delete from tbunidadesnegocios where idunidadnegocio =".$id;
$res = $this->query($sql,0);
return $res;
}


	function traerUnidadesnegocios() {
		$sql = "select
		u.idunidadnegocio,
		u.unidadnegocio,
		(case when u.activo = 1 then 'Si' else 'No' end) activo
		from tbunidadesnegocios u
		order by u.unidadnegocio";
		$res = $this->query($sql,0);
		return $res;
	}

	function traerUnidadesnegociosajax($length, $start, $busqueda) {

		$where = '';

		$busqueda = str_replace("'","",$busqueda);
		if ($busqueda != '') {
			$where = "where u.unidadnegocio like '%".$busqueda."%' or (case when u.activo = 1 then 'Si' else 'No' end) = '".$busqueda."'";
		}

		$sql = "select
		u.idunidadnegocio,
		u.unidadnegocio,
		(case when u.activo = 1 then 'Si' else 'No' end) activo
		from tbunidadesnegocios u
		".$where."
		order by u.unidadnegocio
		limit ".$start.",".$length;

		$res = $this->query($sql,0);
		return $res;
	}


function traerUnidadesnegociosPorId($id) {
$sql = "select idunidadnegocio,unidadnegocio,activo from tbunidadesnegocios where idunidadnegocio =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* Fin de la Tabla: tbunidadesnegocios*/





	/* PARA Horarios */

	function insertarHorarios($hora) {
	$sql = "insert into tbhorarios(idtbhorario,hora)
	values ('',".$hora.")";
	$res = $this->query($sql,1);
	return $res;
	}


	function modificarHorarios($id,$hora) {
	$sql = "update tbhorarios
	set
	hora = ".$hora."
	where idtbhorario =".$id;
	$res = $this->query($sql,0);
	return $res;
	}


	function eliminarHorarios($id) {
	$sql = "delete from tbhorarios where idtbhorario =".$id;
	$res = $this->query($sql,0);
	return $res;
	}


	function traerHorarios() {
	$sql = "select
	h.idtbhorario,
	h.hora
	from tbhorarios h
	order by 1";
	$res = $this->query($sql,0);
	return $res;
	}


	function traerHorariosPorId($id) {
	$sql = "select idtbhorario,hora from tbhorarios where idtbhorario =".$id;
	$res = $this->query($sql,0);
	return $res;
	}

	/* Fin */
	/* /* Fin de la Tabla: tbhorarios*/


	/* PARA Meses */

	function insertarMeses($nombremes) {
	$sql = "insert into tbmeses(mes,nombremes)
	values ('','".($nombremes)."')";
	$res = $this->query($sql,1);
	return $res;
	}


	function modificarMeses($id,$nombremes) {
	$sql = "update tbmeses
	set
	nombremes = '".($nombremes)."'
	where mes =".$id;
	$res = $this->query($sql,0);
	return $res;
	}


	function eliminarMeses($id) {
	$sql = "delete from tbmeses where mes =".$id;
	$res = $this->query($sql,0);
	return $res;
	}


	function traerMeses() {
	$sql = "select
	m.mes,
	m.nombremes
	from tbmeses m
	order by 1";
	$res = $this->query($sql,0);
	return $res;
	}


	function traerMesesPorId($id) {
	$sql = "select mes,nombremes from tbmeses where mes =".$id;
	$res = $this->query($sql,0);
	return $res;
	}

	/* Fin */
	/* /* Fin de la Tabla: tbmeses*/




function query($sql,$accion) {



		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];

		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());

		mysql_select_db($database);

		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}

	}

}

?>

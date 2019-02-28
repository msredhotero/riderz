<?php

require 'includes/funcionesUsuarios.php';

session_start();

$serviciosUsuario = new ServiciosUsuarios();


$ui = $_GET['token'];

$resActivacion = $serviciosUsuario->traerActivacionusuariosPorTokenFechas($ui);

$cadResultado = '';

if (mysql_num_rows($resActivacion) > 0) {


	$idusuario = mysql_result($resActivacion,0,'refusuarios');

	$resUsuario = $serviciosUsuario->traerUsuarioId($idusuario);

	// verifico que el usuario no este activo ya
	if (mysql_result($resUsuario,0,'activo') == 'Si') {
		$cadResultado = 'Usted ya fue dado de alta y esta activo.';
	} else {
		$nombrecompleto = mysql_result($resUsuario,0,'nombrecompleto');
		$cadResultado = '';
	}



	//pongo al usuario $activo
	//$resUsuario = $serviciosUsuario->activarUsuario($idusuario);

	// concreto la activacion
	//$resConcretar = $serviciosUsuario->eliminarActivacionusuarios(mysql_result($resActivacion,0,0));


} else {

	$resToken = $serviciosUsuario->traerActivacionusuariosPorToken($ui);

	if (mysql_num_rows($resToken) > 0) {

		$cadResultado = 'La vigencia para darse de alta a caducado, haga click <a href="prolongar.php?token='.$ui.'">AQUI</a> para prolongar la activación';
	} else {
		$cadResultado = 'Esta clave de Activación es inexistente';
	}

}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Acceder | RIDERZ</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo" style="background-color:#0F0; padding:10px 10px;">
            <a href="javascript:void(0);" style="color:#000;">Activación <b>RIDERZ</b></a>
            <small style="color:#000;">Administración Sistema de Clientes</small>
        </div>
        <div class="card">
            <div class="body demo-masked-input">
               <form id="sign_in" method="POST">
					 	<?php if ($cadResultado == '') { ?>
						<div align="center">
							<h3><?php echo $nombrecompleto; ?></h3>
						</div>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">location_on</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" />
							</div>
						</div>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">date_range</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="fechanacimiento" id="fechanacimiento" placeholder="Fecha Nacimiento (Ejemplo: 1985-05-20)" required/>
							</div>
						</div>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">directions</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio Fiscal (Calle, Nro., Piso, Puerta)*" required/>
							</div>
						</div>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">code</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="codigopostal" id="codigopostal" placeholder="Cod. Postal" />
							</div>
						</div>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">map</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="municipio" id="municipio" placeholder="Municipio del domicilio fiscal"/>
							</div>
						</div>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">code</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="iban" id="iban" placeholder="Tu IBAN (cuenta del banco) 2 letras y 22 numeros." />
							</div>
						</div>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">card_travel</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="nroseguro" id="nroseguro" placeholder="Nro. de Seguro"/>
							</div>
						</div>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">unarchive</i>
							</span>
							<div class="form-line">
								<div class="row">
									<div class="custom-file" id="customFile">
										<input type="file" name="fotofrente" class="custom-file-input" id="fotofrente" aria-describedby="fileHelp" required>
										<label class="custom-file-label" for="exampleInputFile">
											Seleccionar Archivo (tamaño maximo del archivo 4 MB)
										</label>
									</div>
								</div>
							</div>
						</div>


						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">unarchive</i>
							</span>
							<div class="form-line">
								<div class="row">
									<div class="custom-file" id="customFile">
										<input type="file" name="fotodorsal" class="custom-file-input" id="fotodorsal" aria-describedby="fileHelp" required>
										<label class="custom-file-label" for="exampleInputFile">
											Seleccionar Archivo (tamaño maximo del archivo 4 MB)
										</label>
									</div>
								</div>
							</div>
						</div>


						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">grade</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control" name="codigoreferencia" id="codigoreferencia" placeholder="Codigo de Referencia"/>
							</div>
						</div>

						<div class="row js-sweetalert">
							<div class="col-xs-7 p-t-5">
								<a href="index.html">Iniciar sesión</a>
							</div>
							<div class="col-xs-5">
								<button class="btn btn-block bg-riderz waves-effect" data-type="" type="submit" id="login">ACTIVARSE</button>
							</div>
						</div>


						<?php } else { ?>
                  <h4><?php echo $cadResultado; ?></h4>

                  <div class="row m-t-15 m-b--20">
                     <div class="col-xs-6">
                        <a href="index.html">Iniciar Sessión!!</a>
                     </div>
                     <div class="col-xs-6 align-right">

                     </div>
                  </div>
						<?php } ?>
						<input type="hidden" name="idusuario" id="idusuario" value="<?php echo $idusuario; ?>" />
						<input type="hidden" name="accion" id="accion" value="activarUsuario" />
						<input type="hidden" name="activacion" id="activacion" value="<?php echo mysql_result($resActivacion,0,0); ?>" />
               </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <script src="js/pages/ui/dialogs.js"></script>

	 <script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>


    <script type="text/javascript">

        $(document).ready(function(){
			  var $demoMaskedInput = $('.demo-masked-input');

	  			$demoMaskedInput.find('#fechanacimiento').inputmask('yyyy-mm-dd', { placeholder: '____-__-__' });

				$demoMaskedInput.find('#iban').inputmask('aa99 9999 9999 9999 9999 99', { placeholder: '____ ____ ____ ____ ____ __'});

				$('body').keyup(function(e) {
                if(e.keyCode == 13) {
                    $("#login").click();
                }
            });


            $("#sign_in").submit(function(e){

                e.preventDefault();
                if ($('#sign_in')[0].checkValidity()) {
						 var formData = new FormData($("#sign_in")[0]);

                   $.ajax({
								data: formData,
								//necesario para subir archivos via ajax
								cache: false,
								contentType: false,
								processData: false,
                       url:   'ajax/ajax.php',
                       type:  'post',
                       beforeSend: function () {
                               $("#load").html('<img src="imagenes/load13.gif" width="50" height="50" />');
										 $('#login').hide();
                       },
                       success:  function (response) {

                               if (isNaN(response)) {

                                   swal({
                                       title: "Respuesta",
                                       text: "Se genero un error",
                                       type: "error",
                                       timer: 2000,
                                       showConfirmButton: false
                                   });
											  $('#login').show();

                               } else {
                                   swal({
                                       title: "Respuesta",
                                       text: "Su usuario fue activado con Exito.",
                                       type: "success",
                                       timer: 1500,
                                       showConfirmButton: false
                                   });

											  $('#login').hide();

                                   //url = "dashboard/";
                                   //$(location).attr('href',url);
                               }

                       }
                   });
                }


            });


        });/* fin del document ready */

    </script>
</body>

</html>

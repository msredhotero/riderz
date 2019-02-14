<?php

$cuerpo = '<img src="https://saupureinconsulting.com.ar/riderz/imagenes/1PNGlogosRIDERZ.png" alt="RIDERZ" width="190">';

$cuerpo .= '<h2>¡Bienvenido a RIDERZ!</h2>';


$cuerpo .= '<p>Usa el siguente enlace para confirmar tu cuenta.</p>';


$asunto = 'prueba';

$destinatario = 'msredhotero@msn.com';
# Defina el número de e-mails que desea enviar por periodo. Si es 0, el proceso por lotes
# se deshabilita y los mensajes son enviados tan rápido como sea posible.
define("MAILQUEUE_BATCH_SIZE",0);

//para el envío en formato HTML
//$headers = "MIME-Version: 1.0\r\n";

// Cabecera que especifica que es un HMTL
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//dirección del remitente
$headers .= "From: RIDERZ <info@riderzapp.es>\r\n";

//ruta del mensaje desde origen a destino
$headers .= "Return-path: ".$destinatario."\r\n";

//direcciones que recibirán copia oculta
$headers .= "Bcc: msredhotero@msn.com\r\n";

mail($destinatario,$asunto,$cuerpo,$headers);


 ?>

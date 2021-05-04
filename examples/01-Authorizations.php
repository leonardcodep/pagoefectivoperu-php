<?php

 // Usando Composer (o puedes incluir las dependencias manualmente)
 require '../vendor/autoload.php';
/**
 * Ejemplo 1
 * Como crear un Authorizations Pago Efectivo PHP.
 */

try {
 

    $pagoEfectivo = new Pagoefectivo\PagoEfectivo(array('isProduction'=>false,'secretKey' => "Ysy+khByjae6/XaK2HHTEsqa8xrujy02DblRtPbw"));

    $autorizacion = $pagoEfectivo->Authorizations->create(
        array(
            "accessKey" => "MTFmZjlmZTE5YjE2MTEz",
            "idService" => "1035",
        )
    );

    if($autorizacion->code == "100" ){
        echo $autorizacion->data->token;
    }


} catch (Exception $e) {
  echo json_encode($e->getMessage());
}

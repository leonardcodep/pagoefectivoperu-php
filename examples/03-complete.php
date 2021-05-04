<?php

require 'vendor/autoload.php';

try {
    $pagoEfectivo = new Pagoefectivo\PagoEfectivo(array('isProduction'=>false,'secretKey' => "Ysy+khByjae6/XaK2HHTEsqa8xrujy02DblRtPbw"));

    $autorizacion = $pagoEfectivo->Authorizations->create(
        array(
            "accessKey" => "MTFmZjlmZTE5YjE2MTEz",
            "idService" => "1035",
        )
    );

    // REALIZANDO PAFO 
    $pagoCIP = new Pagoefectivo\PagoEfectivo(array('isProduction'=>false,'bearer' => $autorizacion->data->token));

    $pagoResult = $pagoCipPagoEfectivo->CipPagoEfectivo->create(
        array(
            "currency" => "PEN",
            "amount" => "160.35",
            "transactionCode" => "1345",
            "dateExpiry" => 50,
            "userEmail" => "user@example.com",
            // "userDocumentType" => "DNI",
            // "userDocumentNumbe" => "75852565",
            // "userCountry" => "Perú",
            // "paymentConcept" => "Por venta de celular lenovo"
        )
    );



    if($autorizacion->code == "100" ){
        // echo $autorizacion->data->token;
    }
   
    // $myJSON = json_encode($autorizacion);
    $myJSON = json_encode($pagoResult);
    echo $myJSON;
} catch (Exception $e) {
    echo json_encode($e->getMessage());
}


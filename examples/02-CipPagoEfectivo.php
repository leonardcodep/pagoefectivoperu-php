<?php

// Usando Composer (o puedes incluir las dependencias manualmente)
require '../vendor/autoload.php';
/**
 * Ejemplo 2
 * Como crear un CIP PagoEfectivo PHP.
 */

try {
  
    $pagoCIP = new Pagoefectivo\PagoEfectivo(array('isProduction'=>false,'bearer' => ""));

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

    $resultJSON = json_encode($pagoResult);
    echo $resultJSON;

} catch (Exception $e) {
  echo json_encode($e->getMessage());
}

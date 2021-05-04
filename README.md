# Pago Efectivo - Perú PHP

[![Latest Stable Version](https://poser.pugx.org/leonardcodep/pagoefectivoperu-php/v/stable)](https://packagist.org/packages/leonardcodep/pagoefectivoperu-php)
[![Total Downloads](https://poser.pugx.org/leonardcodep/pagoefectivoperu-php/downloads)](https://packagist.org/packages/leonardcodep/pagoefectivoperu-php)
[![License](https://poser.pugx.org/leonardcodep/pagoefectivoperu-php/license)](https://packagist.org/packages/leonardcodep/pagoefectivoperu-php)

Biblioteca PHP oficial de PagoEfectivo - Perú, pagos simples en tu sitio web.

La libertad de elegir dónde y cómo pagar utilizando el código de pago CIP
## Requisitos

* PHP ^7.2 o superiores.
* Credenciales de Pafoefectivo (1).

(1) Debes registrarte [aquí](https://centraldeayuda.pagoefectivo.pe/hc/es/requests/new). Luego, se pondran en contacto el equipo de Pafoefectivo te pediran una serie de datos.

![alt tag](https://ayuda.tiendamia.com/hc/article_attachments/360049511091/screenshot-tiendamia.com-2020.02.11-16_44_50.png)

## Instalación

### Vía Composer
```json
{
  "require": {
    "leonardcodep/pagoefectivoperu-php": "dev-master"
  }
}
```

Y cargar todo usando el autoloader de Composer.

```php
require 'vendor/autoload.php';
```

## Creando Autorización

1°- `isProduction` Variable  boolean permite usar api de desarrolo o de producción.
2°- `secretKey` Variable  proporcionado por PafoEfectivo.
3°- `accessKey` Variable  proporcionado por PafoEfectivo.
4°- `idService` Variable  proporcionado por PafoEfectivo id de tu tienda de 4 digitos.

```php
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

```


## Creando CIP

1°- `isProduction` Variable  boolean permite usar api de desarrolo o de producción.
2°- `secretKey` Variable  proporcionado por PafoEfectivo.
3°- `accessKey` Variable  proporcionado por PafoEfectivo.
4°- `idService` Variable  proporcionado por PafoEfectivo id de tu tienda de 4 digitos.

Todo los parametros comentados son opcionales
```php
<?php

// Usando Composer (o puedes incluir las dependencias manualmente)
require '../vendor/autoload.php';
/**
 * Ejemplo 2
 * Como crear un CIP PagoEfectivo PHP.
 */

try {
  
    $pagoCIP = new Pagoefectivo\PagoEfectivo(array('isProduction'=>false,'bearer' => ""));

    $pagoResult = $pagoCIP->CipPagoEfectivo->create(
        array(
            "currency" => "PEN", // OR USD
            "amount" => 160.35,
            "transactionCode" => 1345, // EL ID DE TU PEDIDO DE TU SISTEMA
            // "paymentConcept" => "Venta de zapatillas", //(OPCIONAL)
            // "additionalData" => "Venta por verano", //(OPCIONAL)
            // "adminEmail" => "venta@mitienda.com", //(OPCIONAL)
            "userEmail" => "user@example.com",
            // "userId" => "12", // ID DE USUARIO DE TU SISTEMA (OPCIONAL)
            // "userName" => "Leonardo ", //(OPCIONAL)
            // "userLastName" => "Manuel Alvarez", //(OPCIONAL)
            // "userUbigeo" => "150115", // Ubigeo de la operación (INEI), ejemplo:150115 (Lima-Lima-La Victoria).
            // "userCountry" => "Perú", //País del usuario. (OPCIONAL)
            // "userDocumentType" => "DNI", // OR DNI (Documento nacional de identidad) , PAR (Partida), PAS (Pasaporte), LMI (Libreta militar) y NAN (Otro)  (OPCIONAL)
            // "userDocumentNumbe" => "75241285", //(OPCIONAL)
            // "userPhone" => "987456321", //(OPCIONAL)
            // "userCodeCountry" => "+51", //(OPCIONAL)
        )
    );

    $resultJSON = json_encode($pagoResult);
    echo $resultJSON;

} catch (Exception $e) {
  echo json_encode($e->getMessage());
}

```





## Ejemplo completo

```php
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

    // REALIZANDO PAGO
    if($autorizacion->code == "100" ){
        // echo $autorizacion->data->token;
        $pagoCIP = new Pagoefectivo\PagoEfectivo(array('isProduction'=>false,'bearer' => $autorizacion->data->token));

        $pagoResult = $pagoCIP->CipPagoEfectivo->create(
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
    }
   
    // $myJSON = json_encode($autorizacion);
    $myJSON = json_encode($pagoResult);
    echo $myJSON;
} catch (Exception $e) {
    echo json_encode($e->getMessage());
}



```
<?php
namespace Pagoefectivo;

use Pagoefectivo\Error as Errors;

/**
 * Class Client
 * 
 * 
 * @package Pagoefectivo
 */
class Client {

    public function request($method, $url, $pagoefectivo, $info = NULL) {
        $isProductions = $pagoefectivo->isProduction;
      
        try {
    
            $fechaAutorizacion = $this->todayDay();
            
            $autorizacionHash = hash ("sha256", 
                $info['idService'].".".
                $info['accessKey'].".".
                $pagoefectivo->secretKey.".".
                $fechaAutorizacion
            );

            $data = array(
                "accessKey" => $info['accessKey'],
                "idService" => $info['idService'],
                "dateRequest" => $fechaAutorizacion,
                "hashString" => $autorizacionHash
            );

            $autorizacionCuerpo = "{".
                "\"accessKey\": \"". $info['accessKey'] ."\",".
                "\"idService\": ". $info['idService'] .",".
                "\"dateRequest\": \"". $fechaAutorizacion ."\",".
                "\"hashString\": \"". $autorizacionHash ."\"".
                "}";
            
            $headers= array(
                "Content-Type" => "application/json", 
                "Accept" => "application/json",
                'content' => $autorizacionCuerpo, 
            );


            $options = array(
                'timeout' => 120
            ); 
            
            if($isProductions){
                $base_url = PagoEfectivo::BASE_URL;
            } else{
                $base_url = PagoEfectivo::BASE_URL_PRUEBA;
            }
            
            $response = \Requests::post($base_url . $url, $headers, json_encode($data), $options);
            
        } catch (\Exception $e) {
            throw new Errors\UnableToConnect();
        }
        if ($response->status_code >= 200 && $response->status_code <= 206) {
            return json_decode($response->body);
        }
        if ($response->status_code == 400) {
            throw new Errors\UnhandledError($response->body, $response->status_code);
        }
        if ($response->status_code == 401) {
            throw new Errors\AuthenticationError();
        }
        if ($response->status_code == 404) {
            throw new Errors\NotFound();
        }
        if ($response->status_code == 403) {
            throw new Errors\InvalidApiKey();
        }
        if ($response->status_code == 405) {
            throw new Errors\MethodNotAllowed();
        }
        throw new Errors\UnhandledError($response->body, $response->status_code);
    }
    public function requestCIP($method, $url, $pagoefectivo, $info = NULL ) {
      
        $isProductions = $pagoefectivo->isProduction;
        try {
          
            $data = array(
                "currency" => $info['currency'],
                "amount" => $info['amount'],
                "transactionCode" => $info['transactionCode'],
                "dateExpiry" => $this->dateExpiry($info['dateExpiry']),
                "paymentConcept" => (isset($info['paymentConcept'])) ? $info['paymentConcept']: NULL,
                "additionalData" => (isset($info['additionalData'])) ? $info['additionalData']: NULL,
                "adminEmail" => (isset($info['adminEmail'])) ? $info['adminEmail']: NULL,
                "userEmail" => $info['userEmail'],
                "userId" => (isset($info['userId'])) ? $info['userId']: NULL,
                "userName" => (isset($info['userName'])) ? $info['userName']: NULL,
                "userLastName" => (isset($info['userLastName'])) ? $info['userLastName']: NULL,
                "userUbigeo" => (isset($info['userUbigeo'])) ? $info['userUbigeo']: NULL,
                "userCountry" => (isset($info['userCountry'])) ? $info['userCountry']: NULL,
                "userDocumentType" => (isset($info['userDocumentType'])) ? $info['userDocumentType']: NULL,
                "userDocumentNumbe" => (isset($info['userDocumentNumbe'])) ? $info['userDocumentNumbe']: NULL,
                "userPhone" => (isset($info['userPhone'])) ? $info['userPhone']: NULL,
                "userCodeCountry" => (isset($info['userCodeCountry'])) ? $info['userCodeCountry']: NULL,
            );

            $headers= array(
                "Accept-Language" => "es-PE", 
                "Origin" => "web",
                "Content-Type" => "application/json",
                "Authorization" => "Bearer ".$pagoefectivo->secretKey
            );


            $options = array(
                'timeout' => 120
            ); 
            
            if($isProductions){
                $base_url = PagoEfectivo::BASE_URL;
            } else{
                $base_url = PagoEfectivo::BASE_URL_PRUEBA;
            }
            
            $response = \Requests::post($base_url . $url, $headers, json_encode($data), $options);
            
        } catch (\Exception $e) {
            throw new Errors\UnableToConnect();
        }
        if ($response->status_code >= 200 && $response->status_code <= 206) {
            return json_decode($response->body);
        }
        if ($response->status_code == 400) {
            throw new Errors\UnhandledError($response->body, $response->status_code);
        }
        if ($response->status_code == 401) {
            throw new Errors\AuthenticationError();
        }
        if ($response->status_code == 404) {
            throw new Errors\NotFound();
        }
        if ($response->status_code == 403) {
            throw new Errors\InvalidApiKey();
        }
        if ($response->status_code == 405) {
            throw new Errors\MethodNotAllowed();
        }
        throw new Errors\UnhandledError($response->body, $response->status_code);
    }
    private function todayDay(){
        $fechaAutorizacion= date_create('now', timezone_open('America/Lima'));
        return date_format($fechaAutorizacion,DATE_ATOM);
    }
    private function dateExpiry($TiempoExpiracionPago=50){
        $fechaAutorizacion= date_create('now', timezone_open('America/Lima'));
        $fechaAutorizacion->add(new \DateInterval('PT'. $TiempoExpiracionPago .'H'));
        return date_format($fechaAutorizacion,DATE_ATOM);
    }
}

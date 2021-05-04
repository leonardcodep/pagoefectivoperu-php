<?php
namespace Pagoefectivo;

use Pagoefectivo\Error as Errors;

/**
 * Class PagoEfectivo
 *
 * @package Pagoefectivo
 */
class PagoEfectivo
{
    public $secretKey;
    public $isProduction;
    /**
    * La versión de API usada
    */
    const API_VERSION = "v0.0.1";
    /**
     * La URL Base por defecto
     */
    const BASE_URL = "https://services.pagoefectivo.pe/v1";   

    /**
     * La URL Base de prueba
     */ 
    const BASE_URL_PRUEBA = "https://pre1a.services.pagoefectivo.pe/v1"; 

    /**
     * Constructor.
     *
     * @param array|null $options
     *
     * @throws Error\InvalidApiKey
     *
     * @example array('secretKey' => "{secretKey}")
     *
     */
    public function __construct($options)
    {
        $this->isProduction = $options['isProduction'];
        $this->secretKey = (isset($options["secretKey"])) ? $options["secretKey"] :$options["bearer"] ;
        if (!$this->secretKey) {
          throw new Errors\InvalidApiKey();
        }
        $this->Authorizations = new Authorizations($this);
        $this->CipPagoEfectivo = new CipPagoEfectivo($this);
    }
}

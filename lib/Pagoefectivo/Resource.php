<?php

namespace Pagoefectivo;

/**
 * Class Resource
 *
 * @package Pagoefectivo
 */
class Resource extends Client {

    /**
     * Constructor.
     */
    public function __construct($pagoefectivo)
    {
        $this->pagoefectivo = $pagoefectivo;
    }

}

<?php

namespace Pagoefectivo;

/**
 * Class Authorizations 
 *
 * @package Pagoefectivo
 */
class Authorizations extends Resource {

    const URL_AUTHOTIZATION = "/authorizations";


    /**
     * @param array|null $options
     *
     * @return create Authorizations response.
     */
    public function create($options = NULL) {
        return $this->request("POST", self::URL_AUTHOTIZATION, $this->pagoefectivo, $options);
    }

}

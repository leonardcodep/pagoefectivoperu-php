<?php

namespace Pagoefectivo;

/**
 * Class CipPagoEfectivo
 *
 * @package Pagoefectivo
 */
class CipPagoEfectivo extends Resource {

  const URL_CIP = "/cips";

  /**
   * @param string|null $id
   *
   * @return POST a Event.
  */

  public function create($options = NULL) {
    return $this->requestCIP("POST", self::URL_CIP, $this->pagoefectivo, $options);
    }

}

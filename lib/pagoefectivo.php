<?php
/**
 * PAGOEFECTIVO - PERÚ PHP SDK
 *
 * Init, cargamos todos los archivos necesarios
 *
 * @version 0.0.1
 * @package Pagoefectivo
 * @copyright Copyright (c) 2021-2025 Pagoefectivo
 * @license MIT
 * @license https://opensource.org/licenses/MIT MIT License
 * @link https://pagoefectivo.pe/desarrolladores.html pago Efectivo Developers
 */

// Errors
include_once dirname(__FILE__).'/Pagoefectivo/Error/Errors.php';
include_once dirname(__FILE__).'/Pagoefectivo/Client.php';
include_once dirname(__FILE__).'/Pagoefectivo/Resource.php';

// Culqi API
include_once dirname(__FILE__).'/Pagoefectivo/Authorizations.php';
include_once dirname(__FILE__).'/Pagoefectivo/PagoEfectivo.php';

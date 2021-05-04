<?php
namespace Pagoefectivo\Error;

/**
 * PagoEfectivo Exceptions
 */

/**
 * Base PagoEfectivo Exception
 */
class PagoEfectivoException extends \Exception {
    protected $message = "Base Pago Efectivo Exception";
}
/**
 * Input validation error
 */
namespace Pagoefectivo\Error;

class InputValidationError extends PagoEfectivoException {
    protected $message = "Error de validacion en los campos";
}
/**
 * Authentication error
 */
namespace Pagoefectivo\Error;

class AuthenticationError extends PagoEfectivoException {
    protected $message = "Error de autenticación";
}
/**
 * Resource not found
 */
namespace Pagoefectivo\Error;

class NotFound extends PagoEfectivoException {
    protected $message = "Recurso no encontrado";
}
/**
 * Method not allowed
 */
namespace Pagoefectivo\Error;

class MethodNotAllowed extends PagoEfectivoException {
    protected $message = "Method not allowed";
}
/**
 * Unhandled error
 */
namespace Pagoefectivo\Error;

class UnhandledError extends PagoEfectivoException {
    protected $message = "Unhandled error";
}
/**
 * Invalid API Key
 */
namespace Pagoefectivo\Error;

class InvalidApiKey extends PagoEfectivoException {
    protected $message = "API Key invalido";
}
/**
 * Unable to connect to Pagoefectivo API
 */
class UnableToConnect extends PagoEfectivoException {
    protected $message = "Imposible conectar a Pago Efectivo API";
}

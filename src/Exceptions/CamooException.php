<?php
namespace CAMOO\Exceptions;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/Exceptions/CamooException.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CAMOO API Exception
 *
 * @link http://www.camoo.cm
*/

/**
 * Class HttpClientException
 *
 */
use Exception;
class CamooException extends Exception {
    /**
     * Json encodes the message and calls the parent constructor.
     *
     * @param null           $message
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct(json_encode($message), $code, $previous);
    }

}

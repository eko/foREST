<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

/**
 * ForestException
 */
class Exception extends \Exception {
    /**
     *
     * @param string $message
     * @param string $code
     * @param string $previous
     */
    public function __construct ($message, $code = null, $previous = null) {
        Logger::singleton()->write($message);
        throw new \Exception($message, $code, $previous);
    }
}
?>
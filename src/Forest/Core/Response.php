<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

/**
 * Response
 */
class Response
{
    /**
     * Response data
     * @var array
     */
    public $_data = array();
    
    /**
     * Return data
     * 
     * @return array $_data
     */
    public function getData() {
        return $this->_data;
    }
    
    /**
     * Set response data
     * 
     * @param array $data
     * 
     * @return array $_data
     */
    public function setData($data) {
        $this->_data = $data;
    }
}

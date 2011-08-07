<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

/**
 * Logger
 */
class Logger extends Abstraction {
    /**
     * INFO level
     */
    const LEVEL_INFO = 'INFO';
    
    /**
     * WARNING level
     */
    const LEVEL_WARN = 'WARNING';
    
    /**
     * Logs file path
     * @var string
     */
    private $_path = 'logs';
    
    /**
     * Debug filename
     * @var string
     */
    private $_filename = 'debug.log';
    
    /**
     * Constructor
     * 
     * @param string $path
     * @param string $filename
     */
    public function __construct($path = null, $filename = null) {
        if (null !== $path) {
            $this->path = $path;
        }
        
        if (null !== $filename) {
            $this->_filename = $filename;
        }
    }
    
    /**
     * Get full log filepath
     * 
     * @return string
     */
    public function getFilepath() {
        return realpath($this->_path) . DIRECTORY_SEPARATOR . $this->_filename;
    }
    
    /**
     * Return level and date format prefixes
     * 
     * @param string $level
     * 
     * @return string
     */
    public function getPrefixes($level) {
        return '[' . $level . '] ' . date('Y-m-d H:i:s') . ' - ';
    }
    
    /**
     * Write message in logs
     * 
     * @param string $message
     * @param const $level
     */
    public function write($message, $level = self::LEVEL_INFO) {
        $file = fopen($this->getFilepath(), 'a');
        fwrite($file, $this->getPrefixes($level) . $message . "\r\n");
        fclose($file);
    }
}
?>

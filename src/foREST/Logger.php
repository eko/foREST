<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace foRest\Logger;

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
    private $path = 'logs';
    
    /**
     * Debug filename
     * @var string
     */
    private $filename = 'debug.log';
    
    /**
     * Constructor
     * @param string $path
     */
    public function __construct($path = null) {
        if (null !== $path) {
            $this->path = $path;
        }
    }
    
    /**
     * Set debug filename
     * @param string $filename
     */
    public function setFilename($filename) {
        $this->filename = $filename;
    }
    
    /**
     * Write message in logs
     * @param string $message
     * @param const $level
     */
    public static function write($message, $level = self::LEVEL_INFO) {
        $file = fopen($this->path . '/' . $this->filename, 'a');
        fwrite($file, '[' . $level . '] ' . $message . "\r\n");
        fclose($file);
    }
}
?>

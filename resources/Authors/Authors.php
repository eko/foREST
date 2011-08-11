<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Resources;

use Forest\Core\Resource as Resource;

/**
 * Authors
 */
class Authors extends Resource {
    /**
     * List all authors
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function getAuthors(Request $request) {
        return array('authors' => array('author1', 'author2'));
    }
}
?>
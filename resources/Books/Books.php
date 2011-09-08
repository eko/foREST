<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Resources;

use Forest\Core\Request,
    Forest\Core\Resource;

/**
 * Books
 */
class Books extends Resource {
    /**
     * List all books
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function getBooks(Request $request) {
        return array('books' => array('book1', 'book2'));
    }
}

<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core\Filters;

use Forest\Core\Exception,
    Forest\Core\Registry,
    Forest\Core\Request,
    Forest\Core\Response;

/**
 * Access
 */
class Access
{
    /**
     * Access filter method (verify access control)
     *
     * @param Request &$request
     * @param Response &$response
     */
    public function filter(Request &$request, Response &$response) {
        $users = Registry::get('users');
        
        $user = $request->getUser();
        $route = $request->getRoute();
        
        $role = $route->getRole();
        
        if (isset($users[$user])) {
            $userRole = $users[$user]['role'];
            
            if ('none' != $userRole && null !== $role && ($role != $userRole)) {
                throw new Exception(
                    sprintf('User %s is not allowed to access route: %s', $user, $route->getName()),
                    401
                );
            }
        }
    }
}

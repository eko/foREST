foREST PHP API
==============

Informations
------------

This is an API written by Vincent Composieux <vincent.composieux@gmail.com>, a PHP web developer.
Blog : http://vincent.composieux.fr

This project is using two Symfony2 components : Console and YAML parser.

Version 1.0
-----------

A really simple, light and powerful API fully compatible and written with PHP 5.3

### Start a new project

Stars by editing the `www/index.php` file contains the basis information to start a new API:

```php
<?php
define('APPLICATION_ENV', 'local');

require_once __DIR__ . DIRECTORY_SEPARATOR . '../src/Forest/Bootstrap.php';

$forest = new Forest\Bootstrap(APPLICATION_ENV);
```

`APPLICATION_ENV` can be defined to set multiple your environments. You can access the environment by calling `getEnvironment()` Kernel method.

Also, you will need to define the `.htpasswd` absolute path so you will need to change this path:

`AuthUserFile /var/www/forest/www/.htpasswd`

Ok, your API is now ready to use.

### Configuration files

There is 3 configuration files in `config/` directory, written in YAML format:
> `configuration.yml` allow you to set configuration variables,
> `databases.yml` allow you to define multiple databases connections to use in your API,
> `users.yml` contains your users list with their roles to allow them to manage access to routes.

### Create a new user

This is very simple to create a new user with the console.
Simply type the following command line: `php console user:add [username] [password] [role]` (role is optional).
Delete a user with `php console user:del [username]`.

To complete your actions, don't forget to refresh the `.htpasswd` file with `php console user:refresh`.

### Create a new resource

Resources consists to create 3 files :
> `routing.yml` that contains routes,
> `queries.yml` that can contains some databases queries,
> `Resource.php` file (which needs to be named as same as folder name) that contains your PHP methods.

For example, your `Books.php` for a Books resource which looks like this:

```php
<?php
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
```

### More

Response duration time is send to requests header.

For more details, please looks the structure of the project or don't hesitate to contact me.

Happy coding!
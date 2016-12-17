
# Installation


## Option 1: Composer

The [Composer](https://getcomposer.org/) package manager is an easy way to manage dependencies in your PHP projects. All Nirvarnia packages are available from the default [Packagist](https://packagist.org/) repository.

Add the following to your project's composer.json file then run ``composer update`` (or ``composer update --no-dev`` in production environments).

```json
{
    "require": {
        "nirvarnia/autoloader": "^2.0"
    }
}
```

Alternatively, run the following command:

```bash
composer require nirvarnia/autoloader:^2.0
```


## Option 2: PEAR

This package is also available from the [Nirvarnia PEAR channel](http://pear.nirvarnia.org) and can be installed using the [PEAR package manager](http://pear.php.net/).

```bash
pear channel-discover pear.nirvarnia.org
pear install --alldeps nirvarnia/autoloader
```

Of course, you must explicitly include the Autoloader.php file before you can use it.

```php
require_once 'path/to/Nirvarnia/Autoloader/Autoloader.php';
```


## Option 3: Manual installation

Download the source files from this project's [git repository](https://github.com/nirvarnia/autoloader). Copy the contents of the ./src/ directory to your project and ``include`` the Autoloader.php file.

This package has no external dependencies.



# Nirvarnia\Autoloader

A simple PSR-4 compatible class loader. 

Based on the demo PSR-4 autoloader provided by the PHP Framework Interoperability Group, the authors of the PSR-4 autoloading standard.


## Requirements

* PHP ≥ 7.0

This package is tested on the most recent stable release of [Zend PHP](http://php.net/) 7.0. It has not been tested on [HHVM](http://hhvm.com/) or any other PHP runtime environments.

This package is developed for the [Nirvarnia](https://www.nirvarnia.org/) framework but it can be used independently.


## Installation

Download the source files from this project's [Github repository](https://github.com/nirvarnia/autoloader). Copy the contents of the ./src/ directory to your project and `include` the Autoloader.php file.

This package is **not** available on [Packagist](https://packagist.org/), the official repository for the [Composer](https://getcomposer.org/) package manager.


## Usage

	$autoloader = new \Nirvarnia\Autoloader($base_dir);
    $autoload->register($prefix, $directory);

`$base_dir` is an optional base directory for all autoloadable resources. If you do not provide a base directory, it will be set to PHP's include path.

The `register()` method adds a new autoloading rule. `$prefix` is a namespace prefix and `$directory` is a directory path - relative to `$base_dir` - containing the classes and interfaces for the given namespace prefix.

Optionally, a single namespace prefix may have classes littered about more than one base directory. If so, provide an array of directory paths as the second parameter.

    $autoload->register($prefix, [$directory, $directory, $directory]);

Example:

	$base_dir = dirname(dirname(__FILE__));
    $autoloader = new \Nirvarnia\Autoloader($base_dir);

	$autoloader->register('Test', '/tests/Test');
    $autoloader->register('Carbon', '/vendor/nesbot/carbon/src/Carbon');
	$autoloader->register('Monolog', '/vendor/monolog/monolog/src/Monolog');
	$autoloader->register('Symfony\\Component\\Yaml', '/vendor/symfony/yaml');

The Nirvarnia Autoloader automatically registers itself as an SPL autoloader - there is no need to call `spl_autoload_register()`.

## Tests

A full suite of unit tests are included in the ./tests/ directory. The tests require PHPUnit 5.3 or higher. If you are using Composer to manage your project's dependencies, PHPUnit will be installed automatically in development environments. To install PHPUnit manually, refer to the documentation on the PHPUnit website: https://phpunit.de/manual/current/en/installation.html.

To run the tests, type the following command from your project's root directory:

    vendor/bin/phpunit


## Comments

This package's API is documented within the source code itself, via inline comments that conform to the [PSR-5 PHPDoc](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md) standard.

[ApiGen](http://www.apigen.org/) is used to check the quality of the inline documentation. From the project's root directory, run the following command to generate documentation from the source code. The documentation will be installed in a new directory called ./apigen/.

    apigen generate


## Contributors

This library is maintained by [Kieran Potts](https://www.kieranpotts.com/).

To contribute to this project, please follow the instructions in the [CONTRIBUTING](CONTRIBUTING.md) file.


## License

This library is released under the MIT License. See the [LICENSE](LICENSE.txt) file for details.


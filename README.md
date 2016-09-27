# Nirvarnia Autoloader

Nirvarnia Autoloader is a simple PSR-4 compatible class loader. It is based on the PSR-4 example autoloader provided by the PHP Framework Interoperability Group (the authors of the PSR-4 autoloading standard).

Usage:

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

The Nirvarnia Autoloader automatically registers itself as an SPL autoloader - there is no need to call spl_autoload_register().

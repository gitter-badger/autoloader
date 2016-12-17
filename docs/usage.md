
# Usage

```php
use Nirvarnia\Autoloader\Autoloader;

$autoloader = new Autoloader($base_dir);
$autoload->register($prefix, $directory);
```

``$base_dir`` is an optional base directory for all autoloadable resources. If you do not provide a base directory, it will be set to PHP's include path.

The ``register()`` method adds a new PSR-4 autoloading rule. ``$prefix`` is a namespace prefix and ``$directory`` is a directory path (which is relative to ``$base_dir``) that contains the classes and interfaces for the given namespace prefix.

Optionally, a single namespace prefix may have classes littered about more than one directory. If so, provide an array of directory paths as the second parameter.

```php
$autoload->register($prefix, [$directory, $directory, $directory]);
```

Example:

```php
$base_dir = dirname(dirname(__FILE__));
$autoloader = new \Nirvarnia\Autoloader\Autoloader($base_dir);

$autoloader->register('Carbon', '/vendor/nesbot/carbon/src/Carbon');
$autoloader->register('Monolog', '/vendor/monolog/monolog/src/Monolog');
$autoloader->register('Symfony\\Component\\Yaml', '/vendor/symfony/yaml');
```

The Nirvarnia Autoloader automatically registers itself as an SPL autoloader, so there is no need to call ``spl_autoload_register()``.

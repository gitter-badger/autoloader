<?php declare(strict_types=1);

namespace Nirvarnia;

/**
 * Minimalist PSR-4 compatible autoloading mechanism.
 *
 * Based on the PHP-FIG's PSR-4 example autoloader.
 *
 * Usage:
 *
 *     $autoloader = new \Nirvarnia\Autoloader($base_dir);
 *     $autoload->register($prefix, $directory);
 *
 * Where $base_dir is an optional base directory for all autoloadable resources.
 * If you do not provide a base directory, it will be set to PHP's include path.
 *
 * The register() method adds a new autoloading rule. $prefix is a namespace
 * prefix and $directory is a directory path - relative to $base_dir -
 * containing the classes and interfaces for the given namespace prefix.
 *
 * Optionally, a single namespace prefix may have classes littered about more
 * than one base directory. If so, provide an array of directories as the
 * second argument:
 *
 *     $autoload->register($prefix, [$directory, $directory, $directory]);
 *
 * Nirvarnia Autoloader automatically registers itself as an SPL autoloader.
 * There is no need to call spl_autoload_register().
 *
 * @package     Nirvarnia
 * @subpackage  Nirvarnia Autoloader
 * @version     1.0.0
 * @author      PHP Framework Interoperability Group <https://github.com/php-fig/>
 * @author      Kieran Potts <hello@kieranpotts.com>
 * @copyright   2013-2016 PHP Framework Interoperability Group
 * @copyright   2016 Kieran Potts
 * @license     Public domain
 * @link        https://github.com/nirvarnia/autoloader
 * @link        https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
 */
final class Autoloader
{

    /**
     * @const  VERSION   string
     * Package version number
     */
    const VERSION = '1.0.0';

    /**
     * @var  $prefixes  array
     *
     * An associative array where the key is a namespace prefix and the value
     * is an array of directories for classes in that namespace. Directories
     * are relative to $base_dir.
     */
    private $prefixes = [];

    /**
     * @var  string  $base_dir
	 *
     * The base directory for all autoloadable class paths.
     */
    private $base_dir = null;

    /**
     * Constructor.
     *
     * Sets the base directory for all autoloadable class paths, and registers
     * the load() method with the SPL's autoloader stack.
     *
     * If a base directory is not provided, the base directory will be set to
     * PHP's include path.
     *
     * @params  string|null  $base_dir
     */
    public function __construct(string $base_dir = null)
    {
        $this->base_dir = ($base_dir ? $base_dir : get_include_path());
        spl_autoload_register(array($this, 'load'));
    }

    /**
     * Adds a base directory for a namespace prefix.
     *
     * @param   string        $prefix     The namespace prefix.
     * @param   string|array  $directory  One or more directories for class files in the namespace.
     *
     * @return  void
     */
    public function register(string $prefix, $directory)
    {
        // Normalize the namespace prefix and the directory paths.
        $prefix = trim($prefix, '\\') . '\\';
        $directories = (array) $directory;
        foreach ($directories as &$directory) {
            $directory = rtrim($directory, DIRECTORY_SEPARATOR) . '/';
        }

        $this->prefixes[$prefix] = $directories;
    }

    /**
     * Class autoloading method.
     *
     * Takes a fully-qualified class name as its only parameter.
     *
     * Returns the mapped file name on success, or boolean false if the class
     * could not be autoloaded.
     *
     * @param   string  $class
     * @return  string|boolean
     */
    public function load($class)
    {
        // Work backwards through the namespace parts of the fully-qualified
        // class name, until find a mapped file name.
        $prefix = $class;
        while (false !== $pos = strrpos($prefix, '\\')) {

            // Retain the trailing namespace separator in the prefix.
            $prefix = substr($class, 0, $pos + 1);

            // The rest is the relative class name.
            $relative_class = substr($class, $pos + 1);

            // Try to load a mapped file for the prefix + relative class.
            $mapped_file = $this->loadMappedFile($prefix, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }

            // Remove the trailing namespace separator for the next iteration
            // of strrpos().
            $prefix = rtrim($prefix, '\\');
        }

        return false;
    }

    /**
     * Load the mapped file for a namespace prefix and relative class.
     *
     * If a mapped file is successfully loaded, the name of the mapped file
     * is returned. If no mapped file can be loaded, boolean false is returned.
     *
     * @param  string  $prefix          The namespace prefix.
     * @param  string  $relative_class  The relative class name.
     * @return string|boolean
     */
    protected function loadMappedFile($prefix, $relative_class)
    {
        if ( ! array_key_exists($prefix, $this->prefixes)) {
            return false;
        }

        // Look through the base directories for this namespace prefix.
        // If a mapped file exists, require it and exit.
        foreach ($this->prefixes[$prefix] as $directory) {
            $file = $this->base_dir
                  . $directory
                  . str_replace('\\', '/', $relative_class)
                  . '.php';
            if ($this->requireFile($file)) {
                return $file;
            }
        }

        return false;
    }

    /**
     * If a file exists, require it from the file system.
     *
     * @param  string  $file  The file to require.
     * @return boolean        True if the file exists, false if not.
     */
    protected function requireFile($file)
    {
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }

}

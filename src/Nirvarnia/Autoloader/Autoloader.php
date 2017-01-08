<?php
declare(strict_types=1);

/**
 * @package    Nirvarnia
 *
 * @copyright  Kieran Potts
 * @license    Unlicense
 */

namespace Nirvarnia\Autoloader;

/**
 * Minimalist PSR-4 compatible autoloading mechanism.
 */
final class Autoloader
{
    /**
     * @var string
     *
     * The base directory for all autoloadable class paths. If this is null, the
     * PHP include path will be used as the base directory.
     */
    private $base_dir = null;

    /**
     * @var array
     *
     * An associative array where the key is a namespace prefix and the value is
     * an array of directories, each relative to the $base_dir, for autoloadable
     * classes in that namespace
     */
    private $prefixes = [];

    /**
     * Constructor.
     *
     * Sets the base directory for autoloadable classes and registers the load()
     * method with the SPL's autoloader stack. If a base directory is not given,
     * the base directory will be set to PHP's include path.
     *
     * @params string|null $base_dir
     */
    public function __construct(string $base_dir = null)
    {
        $this->base_dir = ($base_dir ? $base_dir : get_include_path());
        spl_autoload_register([$this, 'load']);
    }

    /**
     * Adds a base directory for a namespace prefix.
     *
     * @param string       $prefix    The namespace prefix
     * @param string|array $directory One or more directories for class files in the namespace
     *
     * @return void
     */
    public function register(string $prefix, $directory)
    {
        // Normalize the namespace prefix and the directory paths.

        $prefix = trim($prefix, '\\').'\\';
        $directories = (array) $directory;
        foreach ($directories as &$directory) {
            $directory = rtrim($directory, DIRECTORY_SEPARATOR).'/';
        }

        $this->prefixes[$prefix] = $directories;
    }

    /**
     * Class autoloading method.  Takes a fully-qualified class name and returns
     * the mapped file name or false if the class could not be autoloaded.
     *
     * @param string $class
     *
     * @return string|bool
     */
    public function load(string $class)
    {
        // Work backward through the namespace part of the fully-qualified class
        // name, until a mapped file is found.

        // #1 Retain the trailing namespace separator in the prefix. #2 The rest
        // is the relative class name. #3 Try to find a file for the prefix plus
        // relative class. #4 Remove the trailing namespace separator, ready for
        // the next loop.

        $prefix = $class;
        while (false !== $pos = mb_strrpos($prefix, '\\')) {
            $prefix = mb_substr($class, 0, $pos + 1); // #1
            $relative_class = mb_substr($class, $pos + 1); // #2
            $mapped_file = $this->loadMappedFile($prefix, $relative_class); // #3
            if (!$mapped_file) {
                $prefix = rtrim($prefix, '\\'); // #4
                continue;
            }

            return $mapped_file;
        }

        return false;
    }

    /**
     * Loads the mapped file for a namespace prefix and relative class name.  If
     * a mapped file is successfully loaded, the name of the mapped file will be
     * returned. If not mapped file can be loaded, boolean false is returned.
     *
     * @param string $prefix         The namespace prefix
     * @param string $relative_class The relative class name
     *
     * @return string|bool
     */
    private function loadMappedFile(string $prefix, string $relative_class)
    {
        if (!array_key_exists($prefix, $this->prefixes)) {
            return false;
        }

        // Look through the base directories for the namespace prefix. If a file
        // can be mapped to the path, require it and exit.

        foreach ($this->prefixes[$prefix] as $directory) {
            $file = $this->base_dir
                  .$directory
                  .str_replace('\\', '/', $relative_class)
                  .'.php';
            if (!$this->requireFile($file)) {
                continue;
            }

            return $file;
        }

        return false;
    }

    /**
     * If a file exists, require it from the file system.
     *
     * @param string $file The file to require
     *
     * @return bool True if the file exists, false if not
     */
    private function requireFile(string $file): bool
    {
        if (file_exists($file)) {
            require $file;

            return true;
        }

        return false;
    }
}

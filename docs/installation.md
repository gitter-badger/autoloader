
# Installation

This package is not available via the [Composer](https://getcomposer.org/) package manager. If you are using Composer, you will already be using Composer's own autoloading mechanism.


## Option 1: Manual installation

Download the source files from this project's [git repository](https://github.com/nirvarnia/autoloader). Copy the contents of the ./src/ directory to your project and `include` the Autoloader.php file.

This package has no external dependencies.


## Option 2: PEAR

This package is also available from the [Nirvarnia PEAR channel](http://pear.nirvarnia.org) and can be installed using the [PEAR package manager](http://pear.php.net/).

    pear channel-discover pear.nirvarnia.org
    pear install --alldeps nirvarnia/autoloader

Of course, you must explicitly include the Autoloader.php file before you can use it.

    require_once 'path/to/Nirvarnia/Autoloader.php';

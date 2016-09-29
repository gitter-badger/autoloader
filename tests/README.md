# Tests

The tests require PHPUnit 5.3. If you are using Composer to manage the project's dependencies, the easiest thing to do is declare PHPUnit as dependency via the project's composer.json file:

    {
        "require-dev": {
            "phpunit/phpunit": "5.3.*"
        }
    }

To install PHPUnit manually, download the latest phar from https://phunit.de. Copy the phar file to a new directory called "bin" under your PHP installation directory. Rename the phar file "phpunit.phar".

You will need to create an executable from the phpunit.phar file. The instructions vary depending on your operating system. For Windows, open a command line and run the following commands to create a wrapping batch script called "phpunit.bat":

    cd C:\path\to\PHP\bin
    echo @php "%~dp0phpunit.phar" %* > phpunit.bat
    exit

You will need to be able to run the commands `php` and `phpunit` from the command line from any location on your local filesystem. For Windows, add the relavant paths to the system's PATH environment variable. The paths that need to be included are the directory containing the php.exe file, and the directory containing the phpunit.bat file. Example:

    ;C:\path\to\PHP;C:\path\to\PHP\bin

You might need to restart Windows for these changes to take effect.

For installation instructions for other systems, see the PHPUnit documentation:
https://phpunit.de/manual/current/en/installation.html

Open a command line and confirm that you can run PHPUnit from any path:

    phpunit --version

To run the tests, change to the "tests" directory and run:

    phpunit


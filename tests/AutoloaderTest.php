<?php declare(strict_types=1);

/**
 * This is free and unencumbered software released into the public domain.
 *
 * Anyone is free to copy, modify, publish, use, compile, sell, or
 * distribute this software, either in source code form or as a compiled
 * binary, for any purpose, commercial or non-commercial, and by any
 * means.
 *
 * In jurisdictions that recognize copyright laws, the author or authors
 * of this software dedicate any and all copyright interest in the
 * software to the public domain. We make this dedication for the benefit
 * of the public at large and to the detriment of our heirs and
 * successors. We intend this dedication to be an overt act of
 * relinquishment in perpetuity of all present and future rights to this
 * software under copyright law.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * @see  https://github.com/nirvarnia/autoloader
 * @see  https://www.nirvarnia.org/
 */

use Nirvarnia\Autoloader\Autoloader;

class AutoloaderTest extends PHPUnit_Framework_TestCase
{
    protected $loader;

    protected function setUp()
    {
        $base_dir = dirname(dirname(__FILE__));
        $this->autoloader = new Autoloader($base_dir);

        $this->autoloader->register('Foo', '/mocks/Foo');
        $this->autoloader->register('Bar', '/mocks/Bar');
    }

    public function testLoadFoo()
    {
        $foo = new Foo\Foo();
        $this->assertInstanceOf(Foo\Foo::class, $foo);
    }

    public function testLoadBar()
    {
        $bar = new Bar\Bar();
        $this->assertInstanceOf(Bar\Bar::class, $bar);
    }

    public function testLoadMissing()
    {
        $this->setExpectedException(Error::class);
        new Baz\Baz();
    }

    public function testAutoloadFunctions()
    {
        $functions = spl_autoload_functions();
        list($loader_object, $loader_method) = array_pop($functions);

        $this->assertSame($this->autoloader, $loader_object);
        $this->assertSame('load', $loader_method);
    }

    public function testMultiplePaths()
    {
        $this->autoloader->register('Dib', ['/mocks/Dib', '/mocks/more']);

        $dib = new Dib\Dib();
        $this->assertInstanceOf(Dib\Dib::class, $dib);

        $giz = new Dib\Giz();
        $this->assertInstanceOf(\Dib\Giz::class, $giz);
    }

    public function testMoreAutoloaderInstances()
    {
        $base_dir = dirname(dirname(__FILE__));
        $autoloader = new Autoloader($base_dir);
        $autoloader->register('Zim', '/mocks/Zim');

        $zim = new Zim\Zim();
        $this->assertInstanceOf(Zim\Zim::class, $zim);
    }

    public function testDeclaredClasses()
    {
        $declared = get_declared_classes();

        $this->assertTrue(in_array(Foo\Foo::class, $declared));
        $this->assertTrue(in_array(Bar\Bar::class, $declared));
        $this->assertTrue(in_array(Dib\Dib::class, $declared));
        $this->assertTrue(in_array(Dib\Giz::class, $declared));
        $this->assertTrue(in_array(Zim\Zim::class, $declared));

        $this->assertFalse(in_array(Zim\Nox::class, $declared));
        $this->assertFalse(in_array(Zim\Lov::class, $declared));
    }
}

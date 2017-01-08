<?php
declare(strict_types=1);

namespace Tests;

use Nirvarnia\Autoloader\Autoloader;
use PHPUnit\Framework\TestCase;

class AutoloaderTest extends TestCase
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

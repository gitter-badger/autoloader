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
        $base_dir = dirname(__DIR__);
        $this->autoloader = new Autoloader($base_dir);

        $this->autoloader->register('Foo', '/mocks/Foo');
        $this->autoloader->register('Bar', '/mocks/Bar');
    }

    public function testLoadFoo()
    {
        $foo = new Foo\Foo();
        $this->assertInstanceOf('Foo\Foo', $foo);
    }

    public function testLoadBar()
    {
        $bar = new Bar\Bar();
        $this->assertInstanceOf('Bar\Bar', $bar);
    }

    public function testLoadMissing()
    {
        $this->setExpectedException('Error');
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
        $this->assertInstanceOf('Dib\Dib', $dib);

        $giz = new Dib\Giz();
        $this->assertInstanceOf('\Dib\Giz', $giz);
    }

    public function testMoreAutoloaderInstances()
    {
        $base_dir = dirname(__DIR__);
        $autoloader = new Autoloader($base_dir);
        $autoloader->register('Zim', '/mocks/Zim');

        $zim = new Zim\Zim();
        $this->assertInstanceOf('Zim\Zim', $zim);
    }

    public function testDeclaredClasses()
    {
        $declared = get_declared_classes();

        $this->assertTrue(in_array('Foo\Foo', $declared, true));
        $this->assertTrue(in_array('Bar\Bar', $declared, true));
        $this->assertTrue(in_array('Dib\Dib', $declared, true));
        $this->assertTrue(in_array('Dib\Giz', $declared, true));
        $this->assertTrue(in_array('Zim\Zim', $declared, true));

        $this->assertFalse(in_array('Zim\Nox', $declared, true));
        $this->assertFalse(in_array('Zim\Lov', $declared, true));
    }
}

<?php

namespace Unittest;

use Nulpunkt\PhpStub\Stub;

class StubTest extends \PHPUnit_Framework_TestCase
{
    public function testThatAStubRespondToDefinedMethods()
    {
        $stub = new Stub(['getId' => 42]);
        $this->assertSame(42, $stub->getId());
    }

    public function testThatItHasAllProperties()
    {
        $stub = new Stub();
        $this->assertSame(null, $stub->thing);
    }

    public function testThatItWillCallAAnonomusCallable()
    {
        $identity = function ($argument) {
            return $argument;
        };

        $stub = new Stub(['identity' => $identity]);
        $this->assertSame(42, $stub->identity(42));
    }

    public function testThatItWillCallANamedCallable()
    {
        $stub = new Stub(['callMe' => [$this, 'callMeMaybe']]);
        $this->assertSame("Hello, Rebecca", $stub->callMe("Rebecca"));
    }

    public function callMeMaybe($name)
    {
        return "Hello, ".$name;
    }

    public function testThatItReturnsItSelfIfNothingElse()
    {
        $stub = new Stub();
        $this->assertSame($stub, $stub->getId());
        $this->assertSame($stub, $stub->lol()->hey()->hey());
    }

    public function testThatItReturnsNullIfConfigured()
    {
        $stub = new Stub([], ['chainable' => false]);
        $this->assertSame(null, $stub->getId());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testThatItThrowsIfConfigured()
    {
        $stub = new Stub([], ['throw' => true]);
        $stub->getId();
    }

    public function testItHasAtoStringMethod()
    {
        $stub = new Stub();
        $this->assertSame("", (string)$stub);
    }
}

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

    public function testThatMethodsCanBeAssignedAfterInstantiation()
    {
        $stub = new Stub();
        $stub->myMethod = function() { return 42; };
        $this->assertSame(42, $stub->myMethod());
    }

    public function testThatPropertiesCanBeAssignedAfterInstantiation()
    {
        $stub = new Stub();
        $stub->foo = 'bar';
        $this->assertSame('bar', $stub->foo);
    }

    public function testThatItHasAllProperties()
    {
        $stub = new Stub();
        $this->assertSame(null, $stub->thing);
    }

    public function testCanAccessAsProperty()
    {
        $stub = new Stub(['property' => 42]);
        $this->assertSame(42, $stub->property);
    }

    public function testPropertiesCanBeSeenByIsset()
    {
        $stub = new Stub(['property' => 42]);
        $this->assertTrue(isset($stub->property), 'Properies can be seen by isset');
    }

    public function testPropertiesCanBeUnset()
    {
        $stub = new Stub(['property' => 42]);
        unset($stub->property);
        $this->assertFalse(isset($stub->property), 'Properies can be unset');
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

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Bad method call
     */
    public function testThatItThrowsSpecifiedExceptionIfConfigured()
    {
        $stub = new Stub(
            [],
            [
                'throw' => true,
                'exceptionclass' => 'InvalidArgumentException',
                'exceptionmessage' => 'Bad method call'
            ]
        );
        $stub->getId();
    }

    public function testItHasAtoStringMethod()
    {
        $stub = new Stub();
        $this->assertSame("", (string)$stub);
    }
}

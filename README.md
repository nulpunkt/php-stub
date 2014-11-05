# php-stub

A library for making colaborators, meant for testing.

## Installation
Use composer to require:
```
"nulpunkt/php-stub": "dev-master"
```

## Examples

```php
use Nulpunkt\PhpStub\Stub;

// A standard Stub
$stub = new Stub([
    'answer' => 42,
    'callMe' => function($a) { return $a; } # Anything which is a callable
]);
$stub->foo = 'bar';
$stub->myMethod = function() { return 50; };
echo $stub->answer(); # => 42
echo $stub->answer; # => 42
echo $stub->callMe('maybe'); # => 'maybe'
echo $stub->foo; # => 'bar'
echo $stub->myMethod(); # => 50
echo $stub->lol()->hey(); # => $stub

// Different configurations
$stub = new Stub([], ['chainable' => false]);
echo $stub->lol(); # => null

// We can throw exceptions on missing functions
$stub = new Stub([], ['throw' => true]);
echo $stub->lol(); # throws a RuntimeException

$stub = new Stub(
	[], 
	['throw' => true, 'exceptionclass' => 'InvalidArgumentException', 'exceptionmessage' => 'Bad function call']
);
echo $stub->lol(); # throws an InvalidArgumentException with message "Bad function call"
```

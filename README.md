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
    'callMe' => function($a) { return $a; }
    
]);
echo $stub->answer(); # => 42
echo $stub->callMe('maybe'); # => 'maybe'
echo $stub->lol()->hey(); # => $stub

// Different configurations
$stub = new Stub([], ['chainable' => false]);
echo $stub->lol(); # => null

// Different configurations
$stub = new Stub([], ['throw' => true]);
echo $stub->lol(); # throws a RuntimeException
```

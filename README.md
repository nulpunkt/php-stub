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
$stub = new Stub("answer" => 42);
echo $stub->answer(); # => 42
echo $stub->lol(); # => null
```

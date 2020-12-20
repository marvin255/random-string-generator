Random string generator for symfony
===================================

[![Latest Stable Version](https://poser.pugx.org/marvin255/random-string-generator/v/stable.png)](https://packagist.org/packages/marvin255/random-string-generator)
[![Total Downloads](https://poser.pugx.org/marvin255/random-string-generator/downloads.png)](https://packagist.org/packages/marvin255/random-string-generator)
[![License](https://poser.pugx.org/marvin255/random-string-generator/license.svg)](https://packagist.org/packages/marvin255/random-string-generator)
[![Build Status](https://github.com/marvin255/random-string-generator/workflows/random_string_generator/badge.svg)](https://github.com/marvin255/random-string-generator/actions?query=workflow%3A%22random_string_generator%22)

Installation
------------

Install via composer:

```bash
composer req marvin255/random-string-generator
```

Package will be configured automatically.


Usage
-----

Inject the generator to service or controller via DI:

```php
use Marvin255\RandomStringGenerator\Generator\RandomStringGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SiteController extends AbstractController
{
    private RandomStringGenerator $randomStringGenerator;

    public function __construct(RandomStringGenerator $randomStringGenerator)
    {
        $this->randomStringGenerator = $randomStringGenerator;
    }
}
```

Use one of generation methods:

```php
$this->randomStringGenerator->alphanumeric(10);  // 10 symbols of latin alphabet or digits
$this->randomStringGenerator->alpha(10);         // 10 symbols of latin alphabet
$this->randomStringGenerator->numeric(10);       // 10 symbols of digits
$this->randomStringGenerator->string(10, 'qwe'); // 10 symbols of provided vocabulary
```


Fake random strings for testing
-------------------------------

For purposes of testing we need to be sure about the generated string. You can config bundle to return a prepared string for the test environment.

```yaml
# config/packages/test/marvin255_random_string_generator.yaml
marvin255_random_string_generator:
    dummy: true
    dummy_string: some_fixed_string
```

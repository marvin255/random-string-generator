Random string generator for Symfony
===================================

[![Latest Stable Version](https://poser.pugx.org/marvin255/random-string-generator/v/stable.png)](https://packagist.org/packages/marvin255/random-string-generator)
[![Total Downloads](https://poser.pugx.org/marvin255/random-string-generator/downloads.png)](https://packagist.org/packages/marvin255/random-string-generator)
[![License](https://poser.pugx.org/marvin255/random-string-generator/license.svg)](https://packagist.org/packages/marvin255/random-string-generator)
[![Build Status](https://github.com/marvin255/random-string-generator/workflows/random_string_generator/badge.svg)](https://github.com/marvin255/random-string-generator/actions?query=workflow%3A%22random_string_generator%22)

Installation
------------

Install package via composer:

```bash
composer req marvin255/random-string-generator
```

It will be configured automatically.


Usage
-----

Inject the generator to a service or a controller via DI:

```php
use Marvin255\RandomStringGenerator\Generator\RandomStringGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SiteController extends AbstractController
{
    public function __construct(private readonly RandomStringGenerator $randomStringGenerator)
    {
    }
}
```

Use one of the generators methods:

```php
$this->randomStringGenerator->alphanumeric(10);  // 10 symbols of latin alphabet or digits
$this->randomStringGenerator->alpha(10);         // 10 symbols of latin alphabet
$this->randomStringGenerator->numeric(10);       // 10 symbols of digits
$this->randomStringGenerator->password(10);      // 10 symbols that can be used as password
$this->randomStringGenerator->string(10, 'qwe'); // 10 symbols of provided vocabulary
```


Mock strings for testing
------------------------

Bundle can be configured to return a mock string in the test environment.

```yaml
# config/packages/test/marvin255_random_string_generator.yaml
marvin255_random_string_generator:
    dummy: true
    dummy_string: mock_string
```

All methods calls will return `mock_string`.

# Definitions gatherer

[![Build Status](https://travis-ci.com/PHP-DI-Definitions/definitions-gatherer.svg?branch=master)](https://travis-ci.com/PHP-DI-Definitions/definitions-gatherer)
[![Latest Stable Version](https://poser.pugx.org/php-di-definitions/definitions-gatherer/v/stable.png)](https://packagist.org/packages/php-di-definitions/definitions-gatherer)
[![Total Downloads](https://poser.pugx.org/php-di-definitions/definitions-gatherer/downloads.png)](https://packagist.org/packages/php-di-definitions/definitions-gatherer)
[![Code Coverage](https://scrutinizer-ci.com/g/php-di-definitions/definitions-gatherer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/php-di-definitions/definitions-gatherer/?branch=master)
[![License](https://poser.pugx.org/php-di-definitions/definitions-gatherer/license.png)](https://packagist.org/packages/php-di-definitions/definitions-gatherer)
[![PHP 7 ready](http://php7ready.timesplinter.ch/WyriHaximus/reactphp-http-middleware-clear-body/badge.svg)](https://travis-ci.org/WyriHaximus/reactphp-http-middleware-clear-body)

# Install

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require php-di-definitions/definitions-gatherer
```

Gather definitions from files listed in `composer.json`.

# Usage

Lets say for a project we need [`react/event-loop`]() so we create a package that holds a definition file
(`etc/di/event-loop.php`) with the following contents:

```php
<?php

use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;

return [
    LoopInterface::class => function () {
        return Factory::create();
    },
];
```

And reference to it with the following configuration in `composer.json`:

```json
{
    "extra": {
        "php-di-definitions": {
            "di": [
                "etc/di/event-loop.php"
            ]
        }
    }
}
```

Then using this package you can get that definition (and others) and pass it PHP-DI (or another DI that supports
the same format):

```php
use DI\ContainerBuilder;
use PHPDIDefinitions\DefinitionsGatherer;

$definitions = iterator_to_array(DefinitionsGatherer::gather());
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions($definitions);
$container = $containerBuilder->build();
```

# License

The MIT License (MIT)

Copyright (c) 2023 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

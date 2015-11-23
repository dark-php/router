# PHP7 Routing Package

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

To install router as a Composer package run:

``` bash
$ composer require darktec/router
```

## Usage

First initialize the router
``` php
Router::init();
```

Then create your mappings using METHOD, ROUTE, ACTION where ACTION is a function
``` php
Router::map('GET', '/', '\package\controller@function');

// OR

Router::map('GET', '/', function() {
    echo 1;
});
```

Finally match the request method and URI
``` php
Router::match($method, $uri);
```

If a match is found then the function defined is invoked.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Credits

- [DarkTec][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/darktec/router.svg?style=flat-square
[ico-license]: https://img.shields.io/packagist/l/darktec/router.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/darktec/router/1.0.0.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/darktec/router.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/darktec/router
[link-travis]: https://travis-ci.org/darktec/router
[link-downloads]: https://packagist.org/packages/darktec/router
[link-author]: https://github.com/darktec
[link-contributors]: ../../contributors
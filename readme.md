# AccessLog

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require annanovas/accesslog dev-master
```

run Migration

```bash
$ php artisan migrate
```



Publish vendor files

```bash
$ php artisan vendor:publish --provider="AnnaNovas\AccessLog\AccessLogServiceProvider"
```



Chheck config file for more configuration
```bash
config/accesslog.php
```

Add Route 
```bash
Route::get('accessLogs', '\AnnaNovas\AccessLog\Http\controllers\AccessLogController@index')->name('accessLogs');
```

Next, update config/accesslog.php as per your auth.php
And update your layout in view.

## Usage

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email shahriar.rahman@annanovas.com instead of using the issue tracker.

## Credits

- [Shahriar Rahman][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/annanovas/accesslog.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/annanovas/accesslog.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/annanovas/accesslog/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/annanovas/accesslog
[link-downloads]: https://packagist.org/packages/annanovas/accesslog
[link-travis]: https://travis-ci.org/annanovas/accesslog
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/annanovas
[link-contributors]: ../../contributors

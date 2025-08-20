# AI with PrismPHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devdojo/ai.svg?style=flat-square)](https://packagist.org/packages/devdojo/ai)
[![Total Downloads](https://img.shields.io/packagist/dt/devdojo/ai.svg?style=flat-square)](https://packagist.org/packages/devdojo/ai)

This package provides a simple way to integrate AI into your Laravel application using PrismPHP. The main purpose of this package allows you to use the global **ai()** method and easily get responses back from your favorite AI provider. Learn more below.

## Installation

You can install the package via composer:

```bash
composer require devdojo/ai
```

## Usage

After you've installed the package, you'll want to add your AI Provider API Key. Out of the box DevDojo AI uses OpenAI, so you'll want to grab your OpenAI key and add it to your `.env`

```
OPENAI_API_KEY=sk-proj-aReAlLyLoNgKey...
```

After you've added your API key you are ready to use the **ai** method, which is as simple as the following.

```php
$response = ai('What is the meaning of life?');
```

You may also wish to get a streamed response, which you can do so by adding a callback as the second argument:

```php
$response = ai('What color is the sky?', function($chunk){
    // $chunk will contain the stream text response
});
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email tony@devdojo.com instead of using the issue tracker.

## Credits

-   [Tony Lea](https://github.com/devdojo)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

# AI with PrismPHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devdojo/ai.svg?style=flat-square)](https://packagist.org/packages/devdojo/ai)
[![Total Downloads](https://img.shields.io/packagist/dt/devdojo/ai.svg?style=flat-square)](https://packagist.org/packages/devdojo/ai)

This package provides you with a global **ai()** method to easily get responses from your favorite AI provider. Here are a few examples:

```php
$response = ai('What is the meaning of life?');
```

Or capture the streamed response in a callback

```php
$response = ai('What color is the sky?', function($chunk){
    // $chunk will contain the stream text response
});
```

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

After that, you are ready to use the **ai** method anywher in your app:

```php
Route::get('question', function(){
    echo ai('What is the meaning of life?');
});
```

You can also capture the streamed response, by passing a callback as the second argument.

```php
public function submit($input)
{
    $this->output = ai($input, function($chunk){
        logger($chunk);
    });
}
```

This makes it super easy to return streamed responses in your Livewire components. In fact, this package offers two Single-File Volt component examples.

## Examples

You can publish a few examples by running:

```
php artisan ai:install-examples
```

This will publish two component examples to your project. 

1. **basic-example.blade.php** (a basic example of sending a message and getting a streamed response back)
2. **chat-example.blade.php** (a chat example to show you how to pass an array of messages to create a conversation)

This will allow you to include those example components anywhere in your application. 

```php
<livewire:basic-example />
<livewire:chat-example />
```

You can easily test this out by utilizing the Livewire Starter Kit, Installing this package, Adding your API Key to .env, and then pasting the following into the `<body>` of your **welcome.blade.php** file:

```php
<main class="w-screen h-screen flex items-center bg-stone-100 justify-center">
  <div class="w-full max-w-7xl gap-5 mx-auto flex items-stretch">
      <div class="h-full flex-1 p-10 space-y-5 rounded-xl bg-white shadow-sm">
          <h2 class="text-xl font-semibold">Basic Example</h2>
          <livewire:basic-example />
      </div>
      <div class="h-full flex-1 mx-auto p-10 space-y-5 rounded-xl bg-white shadow-sm">
          <h2 class="text-xl font-semibold">Chat Example</h2>
          <livewire:chat-example />
      </div>
  </div>
</main>
```

This will allow you to use the **basic** message functionality and the **chat** functionality.

GIF HERE

## Configuration

If you would like to change the AI provider and the AI model, you can specify the following `.env` variables:

```
AI_DEFAULT_PROVIDER=openai
AI_DEFAULT_MODEL=gpt-4
```

You can also publish the AI config file that will live at `config/ai.php`:

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AI Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration options for the DevDojo AI package.
    |
    */

    'default_provider' => env('AI_DEFAULT_PROVIDER', 'openai'),
    'default_model' => env('AI_DEFAULT_MODEL', 'gpt-4'),
];
```

## PrismPHP

This package doesn't really do much else besides providing you with an easy to use global **ai()** method. Most of the magic comes from [PrismPHP](https://prismphp.com/), you may wish to abstract this into your own global **ai()** method. All providers that are available via Prism are also supported in this package.

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

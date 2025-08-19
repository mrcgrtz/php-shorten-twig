# Shorten Twig Extension

> A Twig extension for the [`marcgoertz/shorten`](https://github.com/mrcgrtz/php-shorten) package that safely truncates HTML markup while preserving tags, handling entities, and supporting Unicode/emoji with optional word-safe truncation.

[![Test](https://github.com/mrcgrtz/php-shorten-twig/actions/workflows/test.yml/badge.svg)](https://github.com/mrcgrtz/php-shorten-twig/actions/workflows/test.yml)
[![Coverage Status](https://coveralls.io/repos/github/mrcgrtz/php-shorten-twig/badge.svg?branch=main)](https://coveralls.io/github/mrcgrtz/php-shorten-twig?branch=main)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/marcgoertz/shorten-twig)
![Packagist Downloads](https://img.shields.io/packagist/dt/marcgoertz/shorten-twig)
![Packagist Stars](https://img.shields.io/packagist/stars/marcgoertz/shorten-twig)
[![MIT License](https://img.shields.io/github/license/mrcgrtz/php-shorten-twig)](https://github.com/mrcgrtz/php-shorten-twig/blob/main/LICENSE.md)

## Installation

I recommend using [Composer](https://getcomposer.org/) for installing and using the Shorten Twig Extension:

```bash
composer require marcgoertz/shorten-twig
```

## Usage

### Basic Setup

```php
<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Marcgoertz\Shorten\ShortenTwigExtension;

$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);
$twig->addExtension(new ShortenTwigExtension());
?>
```

### Template Usage

```twig
{{ '<a href="https://example.com/">Go to example site</a>'|shorten(10) }}
```

Output:

```html
<a href="https://example.com/">Go to exam</a>…
```

## Filters

### `shorten`

Safely truncate text or HTML markup using the [`marcgoertz/shorten`](https://github.com/mrcgrtz/php-shorten) library.

```twig
shorten(length = 100, suffix = '…', wordsafe = false)
```

#### Parameters

* `int $length`: Maximum length of truncated text (default: `400`)
* `string $appendix`: Text added after truncated text (default: `'…'`)
* `bool $appendixInside`: Add appendix to last content in tags, increases `$length` by 1 (default: `false`)
* `bool $wordsafe`: Wordsafe truncation, cuts at word boundaries (default: `false`)
* `string $delimiter`: Delimiter for wordsafe truncation (default: `' '`)

#### Examples

```twig
{# Basic truncation #}
{{ 'A very long text that needs to be shortened'|shorten(20) }}
{# Output: A very long text th… #}

{# Custom suffix #}
{{ 'A very long text that needs to be shortened'|shorten(20, '...') }}
{# Output: A very long text th... #}

{# Wordsafe truncation #}
{{ 'A very long text that needs to be shortened'|shorten(20, '…', true) }}
{# Output: A very long text… #}

{# HTML markup preservation #}
{{ '<b>Bold text</b> and <i>italic text</i>'|shorten(15) }}
{# Output: <b>Bold text</b> and <i>ita</i>… #}
```

## Features

* ✅ Preserves HTML tag structure and proper nesting
* ✅ Handles HTML entities correctly
* ✅ Supports self-closing tags (both XML and HTML5 style)
* ✅ UTF-8 and multibyte character support (including emojis)
* ✅ Wordsafe truncation to avoid cutting words in the middle
* ✅ Configurable suffix text and placement
* ✅ Easy integration with existing Twig templates
* ✅ Full compatibility with [`marcgoertz/shorten`](https://github.com/mrcgrtz/php-shorten) v5.0+

## Requirements

* PHP 8.2+
* Twig 3.0+
* [`marcgoertz/shorten`](https://github.com/mrcgrtz/php-shorten) 5.0+

## Development

### Running Tests

```bash
composer test
```

### Code Style

```bash
composer lint
composer fix
```

## License

MIT © [Marc Görtz](https://marcgoertz.de/)

# PHP ConditionalProxy

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/php-conditional-proxy.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/php-conditional-proxy)
[![MIT License](https://img.shields.io/github/license/Astrotomic/php-conditional-proxy.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/php-conditional-proxy/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://plant.treeware.earth/Astrotomic/php-conditional-proxy)

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/Astrotomic/php-conditional-proxy/run-tests?style=flat-square&logoColor=white&logo=github&label=Tests)](https://github.com/Astrotomic/php-conditional-proxy/actions?query=workflow%3Arun-tests)
[![StyleCI](https://styleci.io/repos/271375912/shield)](https://styleci.io/repos/271375912)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/php-conditional-proxy.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/php-conditional-proxy)

This package provides a trait and class to allow calling methods based on a condition without breaking the method chain. 
This is useful if you want to call a method only if the variable you insert has a value. 

## Installation

You can install the package via composer:

```bash
composer require astrotomic/php-conditional-proxy
```

## Usage

The easiest will be to use the `\Astrotomic\ConditionalProxy\HasConditionalCalls` trait which adds a `when()` method.
The `\Astrotomic\ConditionalProxy\ConditionalProxy` is made to work with methods returning `$this` because otherwise you can get unexpected results and wrong code-completion.

```php
use Astrotomic\ConditionalProxy\HasConditionalCalls;

class MyClass
{
    use HasConditionalCalls;
}
```

### Conditional chained Method

You can call the `when()` method by only passing the condition and chain the method to call if the condition is `true`.

```php
// foo() bar() baz() will be called
$class->foo()->when(true)->bar()->baz();

// foo() baz() will be called
$class->foo()->when(false)->bar()->baz();
```

### Conditional Callback

If you want you can also pass a callback as second parameter to the `when()` method.

```php
// foo() bar() baz() will be called
$class->foo()->when(true, fn($self) => $self->bar())->baz();

// foo() baz() will be called
$class->foo()->when(false, fn($self) => $self->bar())->baz();
```

### Advanced Usage

If you already have an `if()` or `when()` method and want to advance it or implement this behavior in any other method you can initialize and return the `\Astrotomic\ConditionalProxy\ConditionalProxy` yourself.

```php
use Astrotomic\ConditionalProxy\ConditionalProxy;

class MyClass
{
    public function if($condition)
    {
        return new ConditionalProxy($this, $condition);
    }

    public function foo($foo)
    {
        $this->foo = $foo;

        return $this;
    }
}
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dev@astrotomic.info instead of using the issue tracker.

## Credits

- [Tom Witkowski](https://github.com/Gummibeer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment I would highly appreciate you buying the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at [offset.earth/treeware](https://plant.treeware.earth/Astrotomic/php-conditional-proxy)

Read more about Treeware at [treeware.earth](https://treeware.earth)

<?php

use Astrotomic\ConditionalProxy\HasConditionalCalls;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertSame;

class Proxied
{
    use HasConditionalCalls;

    public $foo;
    public $bar;

    public function foo()
    {
        $this->foo = 'foo';

        return $this;
    }

    public function bar()
    {
        $this->bar = 'bar';

        return $this;
    }
}

it('calls method if condition is true', function () {
    $proxied = new Proxied();
    $proxied
        ->foo()
        ->when(true)
        ->bar();

    assertSame('foo', $proxied->foo);
    assertSame('bar', $proxied->bar);
});

it('calls method after method if condition is true', function () {
    $proxied = new Proxied();
    $proxied
        ->when(true)
        ->bar()
        ->foo();

    assertSame('foo', $proxied->foo);
    assertSame('bar', $proxied->bar);
});

it('skips method if condition is false', function () {
    $proxied = new Proxied();
    $proxied
        ->foo()
        ->when(false)
        ->bar();

    assertSame('foo', $proxied->foo);
    assertNull($proxied->bar);
});

it('calls method after skipped if condition is false', function () {
    $proxied = new Proxied();
    $proxied
        ->when(false)
        ->bar()
        ->foo();

    assertSame('foo', $proxied->foo);
    assertNull($proxied->bar);
});

it('can use non bool truly condition', function () {
    $proxied = new Proxied();
    $proxied
        ->foo()
        ->when('lorem')
        ->bar();

    assertSame('foo', $proxied->foo);
    assertSame('bar', $proxied->bar);
});

it('can use non bool falsy condition', function () {
    $proxied = new Proxied();
    $proxied
        ->foo()
        ->when(null)
        ->bar();

    assertSame('foo', $proxied->foo);
    assertNull($proxied->bar);
});

it('calls callback if condition is true', function () {
    $proxied = new Proxied();
    $proxied
        ->foo()
        ->when(true, function (Proxied $p) {
            return $p->bar();
        });

    assertSame('foo', $proxied->foo);
    assertSame('bar', $proxied->bar);
});

it('skipps callback if condition is false', function () {
    $proxied = new Proxied();
    $proxied
        ->foo()
        ->when(false, function (Proxied $p) {
            return $p->bar();
        });

    assertSame('foo', $proxied->foo);
    assertNull($proxied->bar);
});

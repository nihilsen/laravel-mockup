<?php

namespace Nihilsen\LaravelMockup;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Support\Facades\App;

abstract class Mockup implements UrlRoutable
{
    /**
     * The name of the method which is used to resolve a mockup object.
     *
     * @var string
     */
    public const RESOLVE_METHOD = 'resolve';

    final public function __construct()
    {
        //
    }

    /**
     * Find a mockup object with the given $key.
     *
     * @param  string  $key
     * @return static|null
     */
    public static function find(string $key): ?static
    {
        $resolver = (new \ReflectionMethod(static::class, static::RESOLVE_METHOD))->getClosure();

        return App::call($resolver, [static::keyName() => $key]);
    }

    /**
     * {@inheritDoc}
     */
    public function getRouteKey()
    {
        return $this->{$this->getRouteKeyName()};
    }

    /**
     * {@inheritDoc}
     */
    public function getRouteKeyName()
    {
        return static::keyName();
    }

    /**
     * Get they key of the mockup object.
     *
     * @return string
     */
    public function key(): string
    {
        return $this->{static::keyName()};
    }

    /**
     * Get the key name of the mockup object.
     *
     * @return string
     */
    abstract public static function keyName(): string;

    /**
     * Instantiate the mockup object.
     *
     * @param  mixed  ...$args
     */
    public static function make(...$args)
    {
        $mockup = new static();

        foreach ($args as $key => $value) {
            $mockup->$key = $value;
        }

        return $mockup;
    }

    /**
     * {@inheritDoc}
     */
    public function resolveChildRouteBinding($childType, $value, $field)
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $class = static::class;

        if (! method_exists($this, $method = static::RESOLVE_METHOD)) {
            throw new BindingResolutionException("$class is not resolvable, as it does not have a '$method' method.");
        }

        if (($field ??= $this->getRouteKeyName()) != $this->getRouteKeyName()) {
            throw new BindingResolutionException("$class cannot be retrieved by field other than '{$this->getRouteKeyName()}'.");
        }

        return static::find($value);
    }
}

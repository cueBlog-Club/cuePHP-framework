<?php

namespace SolaTyolo\Lightcache\Exception;

use Psr\SimpleCache\InvalidArgumentException as Psr16ExceptionInterface;
/**
 * Exception interface for invalid cache arguments.
 *
 * When an invalid argument is passed it must throw an exception which implements
 * this interface
 */
class InvalidArgumentException implements Psr16ExceptionInterface
{
}

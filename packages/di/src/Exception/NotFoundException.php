<?php
declare(strict_types=1);

namespace CuePhp\DI\Exception;

use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;

class NotFoundException extends RuntimeException implements NotFoundExceptionInterface
{

}

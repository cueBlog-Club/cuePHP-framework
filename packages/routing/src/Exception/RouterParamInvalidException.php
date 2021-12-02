<?php
declare(strict_types=1);

namespace CuePhp\Routing\Exception;

use InvalidArgumentException;

class RouterParamInvalidException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("router param is invalid");
    }
}

<?php
declare(strict_types=1);

namespace CuePhp\Routing\Exception;

class RouterParamInvalidException extends \Exception
{
    public function __construct()
    {
        parent::__construct("router param is invalid");
    }
}

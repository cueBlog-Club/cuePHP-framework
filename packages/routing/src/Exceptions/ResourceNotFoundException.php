<?php
declare(strict_types=1);

namespace CuePhp\Routing\Exception;

class ResourceNotFoundException extends \Exception
{
    public function __construct(string $path, int $code = 404)
    {
        $message = sprintf('%s  not found', $path);
        parent::__construct($message, $code);
    }
}

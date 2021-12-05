<?php 
declare(strict_types=1);


namespace CuePhp\Session\Handler;

use SessionHandlerInterface;

interface SaveHandlerInterface extends SessionHandlerInterface
{
    public function getAlias(): string;
    
}
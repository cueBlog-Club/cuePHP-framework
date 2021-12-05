<?php
declare(strict_types=1);

namespace CuePhp\DI\Service\Context;

trait ContextTrait
{
    public $ctx;

    public function initContext()
    {
        $this->ctx = new GlobalContext();
    }
}

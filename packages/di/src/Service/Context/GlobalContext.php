<?php
declare(strict_types=1);

namespace CuePhp\DI\Service\Context;

final class GlobalContext extends AbstractContext
{

    public function __construct()
    {
        parent::__construct('', false, true);
    }
}

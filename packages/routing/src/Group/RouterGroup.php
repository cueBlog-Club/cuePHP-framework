<?php
declare(strict_types=1);

namespace CuePhp\Routing\Group;

use Closure;

class RouterGroup
{
    private $_prefix = "";

    /**
     * @var array<Closure>
     */
    private $_middlwares = [];

    /**
     * @var RouterGroup
     */
    private $_parentGroup = null;

}
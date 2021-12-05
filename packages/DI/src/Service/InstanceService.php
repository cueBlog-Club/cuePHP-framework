<?php
declare(strict_types=1);

namespace CuePhp\DI\Service;

class InstanceService implements ServiceInterface
{

    /**
     * @var object
     */
    private $_instance;

    public function __construct(object $instance)
    {
        $this->_instance = $instance;
    }

    public function getInstance(): object
    {
        return $this->_instance;
    }

    public function resolveAsSingleton(): bool
    {
        return true;
    }
}

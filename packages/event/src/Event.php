<?php

declare(strict_types=1);

namespace CuePhp\Event;

use Psr\EventDispatcher\StoppableEventInterface;

class Event implements StoppableEventInterface
{
    /**
     * @var bool
     */
    private $_propagationStapped = false;

    public function isPropagationStopped(): bool
    {
        return $this->_propagationStapped;
    }

    public function stopPropagation(): void
    {
        $this->_propagationStapped = true;
    }
}

<?php

declare(strict_types=1);

namespace CuePhp\Event;

use Psr\EventDispatcher\StoppableEventInterface;
use CuePhp\Event\EventListenerInterface;
use CuePhp\Event\EventDispatcherInterface;

class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var array<string, EventListenerInterface[]>
     */
    private $_listeners = [];

    public function __construct()
    {
    }

    public function dispatch(object $event, string $eventname = null): object
    {
        $eventName = $eventName ?? \get_class($event);
        $listeners = $this->getListeners($eventName);

        if( !empty($listeners) ) {
            $this->callListeners($listeners, $eventName, $event);
        }

        return $event;
    }

    /**
     * @param string|null $eventName
     * @return array<EventListenerInterface>
     */
    public function getListeners(?string $eventName): array
    {
        if ($eventName === null || !isset($this->_listeners[$eventName])) {
            return [];
        }
        return $this->_listeners[$eventName];
    }

    /**
     * @param string|null $eventName
     * @return bool
     */
    public function hasListener(?string $eventName): bool
    {
        if ($eventName !== null) {
            return !empty($this->_listeners[$eventName]);
        }

        return false;
    }

    public function addListener(string $eventName, callable $listener)
    {
        $this->_listeners[$eventName][] = $listener;
    }

    public function deleteListener(string $eventName, ?callable $listener): bool
    {
        if (empty($this->_listeners[$eventName])) {
            return true;
        }
        foreach ($this->_listeners[$eventName] as $index => $savedListener) {
            if ($savedListener === $listener) {
                unset($this->_listeners[$eventName][$index]);
            }
        }
        return true;
    }

    /**
     * @param callable[] $listeners
     * @param string $eventName
     * @param object $event
     */
    protected function callListeners(iterable $listeners, string $eventName, object $event)
    {
        $stoppable = $event instanceof StoppableEventInterface;
        if ($stoppable && $event->isPropagationStopped()) {
            return;
        }
        foreach ($listeners as $listener) {
            $listener($event, $eventName, $this);
        }
    }
}

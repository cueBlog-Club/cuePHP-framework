<?php

declare(strict_types=1);

namespace CuePhp\Event;

use Psr\EventDispatcher\ListenerProviderInterface;

interface EventListenerInterface extends ListenerProviderInterface
{
    /**
     * @param object $event - T event to respond to listeners
     * @return iterable[callable]
     */
    public function getListenersForEvent(object $event): iterable;
}
<?php

declare(strict_types=1);

namespace CuePhp\Event;

use Psr\EventDispatcher\EventDispatcherInterface as PsrEventDispatcherInterface;

interface EventDispatcherInterface extends PsrEventDispatcherInterface
{

    /**
     * 
     */
    public function dispatch(object $event, string $eventName = null): object;

    /**
     * add event listener to dispatcher
     */
    public function addListener( string $eventName, callable $listener );

    /**
     * delete event listener
     */
    public function deleteListener(string $eventName, ?callable $listener): bool;

    public function hasListener( ?string $eventName ): bool;

    public function getListeners(?string $eventName): array;

}
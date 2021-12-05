<?php
declare(strict_types=1);

namespace CuePhp\Session;

interface SessionInterface
{
    /**
     * @return bool
     */
    public function start(): bool;

    /**
     * save all session changed 
     * @return bool
     */
    public function save(): bool;

    /**
     * discard all the session changes and close the session
     * @return bool
     * 
     */
    public function abort(): bool;

    /**
     * delete all data
     * @return bool
     */
    public function flush(): bool;

    /**
     * get current seesion id
     * @return string|null
     */
    public function getId(): ?string;

    /**
     * regenerate a new session id
     * @return self
     */
    public function regenerateId(): self;


    
} 
<?php

declare(strict_types=1);

namespace CuePhp\Cache;

use CuePhp\Cache\Exception\InvalidArgumentException;
use Psr\Cache\CacheItemInterface;
use DateInterval;
use DateTimeImmutable;
use DateTimeInterface;

final class Cache implements CacheItemInterface
{

    /**
     * @var string
     */
    private $_key = '';

    /**
     * @var int
     */
    private $_ttl = 0;

    /**
     * @var mixed
     */
    private $_val;

    private $_isHit = false;

    const DEFAULT_TTL = 5 * 60;

    public function __construct(string $key, $val, int $ttl = self::DEFAULT_TTL)
    {
        $this->_key = $key;
        $this->_val = $val;
        $this->_ttl = $ttl;
    }

    public function setIsHit(bool $isHit)
    {
        $this->_isHit = $isHit;
    }

    public function getKey()
    {
        return $this->_key;
    }

    /**
     * @return ttl
     */
    public function getTTL(): int
    {
        return $this->_ttl;
    }

    public function get()
    {
        if ($this->isHit()) {
            return $this->_val;
        }
        return null;
    }

    public function isHit()
    {
        return $this->_isHit;
    }

    public function set($value)
    {
        $this->_val = $value;
        return $this;
    }

    /**
     * @var DateTimeInterface|null
     * @return static
     * @throws InvalidArgumentException
     */
    public function expiresAt($expiration)
    {
        if ($expiration === null) {
            $this->_ttl = 0;
            return $this;
        }
        if ($expiration instanceof DateTimeInterface) {
            $this->_ttl = strtotime($expiration->format('U.u'));
            return $this;
        }
        throw new InvalidArgumentException('invalid type for expiration');
    }

    /**
     * @var int|DateInterval|null $time
     * @return static
     * @throws InvalidArgumentException
     */
    public function expiresAfter($time)
    {
        if ($time === null) {
            $this->_ttl = 0;
            return $this;
        }

        if (is_int($time)) {
            $this->_ttl = $time;
            return $this;
        }

        if ($time instanceof DateInterval) {
            $date = DateTimeImmutable::createFromFormat('U', (string)time());
            $this->_ttl = $date->add($time)->format('U');
            return $this;
        }

        throw new InvalidArgumentException('invalid type for time');
    }
}

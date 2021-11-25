<?php
declare(strict_types=1);

namespace CuePhp\Cookie;

use CuePhp\Cookie\SameSite;

final class Cookie
{
    /**
     * @var string
     */
    private $_name = "";

    /**
     * raw cookie value
     * @var array|string
     */
    private $_value = "";

    /**
     * @var int
     */
    private $_expire = 0;

    /**
     * @var string
     */
    private $_path = '/';

    /**
     * @var string
     */
    private $_domain = '';

    /**
     * @var bool
     */
    private $_secure = false;

    /**
     * @var bool
     */
    private $_httponly = false;

    /**
     * @var string
     */
    private $_sameSite = '';

    public function __construct(string $name, $value, array $options = [])
    {
        $this->_name = $name;
        $this->_value = $value;
        $this->setOptions($options);
    }

    private function setOptions(array $options = [])
    {
        $this->_expire = isset($options['expires']) ? (int)$options['expires'] : null;
        if (isset($options['max-age'])) {
            $this->_expire = time() + $options['max-age'];
        }
        $this->_path = isset($options['path']) ? $options['path'] : '/';
        $this->_domain = isset($options['domain']) ? $options['domain'] : '';
        $this->_secure = isset($options['secure']) ? (bool)$options['secure'] : false;
        $this->_httponly = isset($options['httponly']) ? (bool)$options['httponly'] : false;
        $this->_sameSite = isset($options['samesite']) ? (string)$options['samesite'] : '' ;
    }


    /**
     * create new cookie instance
     *  @param string $name
     *   @param string|array    $value
     *   @param array $options
     *   @return Cookie
     */
    public static function create(string $name, $value, array $options): Cookie
    {
        return new self(
            $name,
            $value,
            $options
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->_path;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->_domain;
    }

    /**
     * @return bool
     */
    public function getSecure(): bool
    {
        return $this->_secure;
    }

    /**
     * @return bool
     */
    public function getHttpOnly(): bool
    {
        return $this->_httponly;
    }

    /**
     * @return string
     */
    public function getSamesite(): string
    {
        return $this->_sameSite;
    }

    /**
     * @return string|array
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @return int
     */
    public function getExpire(): int
    {
        return $this->_expire;
    }

    /**
     * transfer header cookie string
     * @return string
     */
    public function toHeadersString(): string
    {
        $headers = [];
        if (is_array($this->_value) || is_object($this->_value)) {
            $this->_value = json_encode($this->_value);
        }
        $headers[] = sprintf('%s=%s', $this->_name, rawurldecode($this->_value));
        if ($this->getExpire()) {
            $headers[] = sprintf("expires=%s", $this->getExpire());
        }
        if ($this->getPath()) {
            $headers[] = sprintf("path=%s", $this->getPath());
        }
        if ($this->getDomain()) {
            $headers[] = sprintf("domain=%s", $this->getDomain());
        }
        if ($this->getSamesite()) {
            $headers[] = sprintf("samesite=%s", $this->getSamesite());
        }
        if ($this->getSecure()) {
            $headers[] = 'secure';
        }
        if ($this->getHttpOnly()) {
            $headers[] = 'httponly';
        }
        return implode(';', $headers);
    }
}

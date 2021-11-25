<?php
declare(strict_types=1);

namespace CuePhp\Cookie;

use CuePhp\Cookie\Cookie;

final class CookieManager
{

    /**
     *  new cookie instance
     *   @param string $name
     *   @param string|array    $value
     *   @param array $options
     *   @return Cookie
     */
    public static function new(string $name, $value, array $options): Cookie
    {
        return Cookie::create(
            $name,
            $value,
            $options
        );
    }

    /**
     * get cookie instance from cookie string
     * @var string cookieString
     * @return Cookie
     */
    public static function createFromHeaders(string $cookieString): Cookie
    {
        if (strpos($cookieString, '";"') !== false) {
            $cookieString = str_replace('";"', '{__cookie_replace__}', $cookieString);
            $parts = str_replace('{__cookie_replace__}', '";"', explode(';', $cookieString));
        } else {
            $parts = preg_split('/\;[ \t]*/', $cookieString);
        }
        list($name, $value) = explode('=', array_shift($parts), 2);
        $data = [ ];
        foreach ($parts as $part) {
            if (strpos($part, '=') !== false) {
                [$key, $v] = explode('=', $part);
            } else {
                $key = $part;
                $v = true;
            }

            $key = strtolower($key);
            $data[$key] = $v;
        }
        if (isset($data['max-age'])) {
            $data['expires'] = time() + (int)$data['max-age'];
        }
        return Cookie::create($name, $value, $data);
    }

    /**
     * create cookie instance only with name and value
     * @var string name
     * @return Cookie
     */
    public static function createSimpleCookie(string $name): Cookie
    {
        if (isset($_COOKIE[$name])) {
            $value = substr($_COOKIE[$name], 0, 1) == '{' ? json_decode($_COOKIE[$name]) : $_COOKIE[$name];
            return Cookie::create($name, $value, []);
        }
        return null;
    }

    /**
     * Set Cookie into Http headers
     * @var Cookie $instance
     * @var array $options
     */
    public static function setToClientHeaders(Cookie $cookieInstance, array $options = []): void
    {
        if (is_array($cookieInstance->getValue()) || is_object($cookieInstance->getValue())) {
            $value =  json_encode($cookieInstance->getValue());
        }

        if (count($options) > 0) {
            !isset($options['expires']) && $options['expires'] = $cookieInstance->getExpire();
            !isset($options['path']) && $options['path'] = $cookieInstance->getPath();
            !isset($options['secure']) && $options['secure'] = $cookieInstance->getDomain();
            !isset($options['domain']) && $options['domain'] = $cookieInstance->getSecure();
            !isset($options['httponly']) && $options['httponly'] = $cookieInstance->getHttpOnly();
            !isset($options['samesite']) && $options['samesite'] = $cookieInstance->getSamesite();
        }

        setcookie(
            $cookieInstance->getName(),
            $value,
            $options
        );
    }

    /**
     * delete client cookie
     * @var Cookie $cookie
     * @return void
     */
    public static function deleteClientCookie(Cookie $cookie): void
    {
        self::setToClientHeaders($cookie, [ 'expires' => time() - 1 ]);
        unset($_COOKIE[$cookie->getName()]);
    }
}

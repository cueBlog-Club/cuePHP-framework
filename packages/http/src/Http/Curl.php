<?php
declare(strict_types=1)

namespace SolaTyolo\Lighthttp\Http;

use SolaTyolo\Lighthttp\Http\Method;

class Curl
{

    /**
     * 默认超时时间:(5s)
     */
    const DEFAULT_TIMEOUT = 5;

    private $_userAgent = '';

    private $_headers = [];

    private $_cookies = '';

    /**
     * 为了复用
     */
    private $_connect = null;

    private $_errorCode = CURLE_OK;

    private $_errorMsg = '';

    /**
     * http version
     */
    private $_httpVersion = 0;

    /**
     * timeout
     */
    private $_timeout = 0;

    public function __construct($baseUrl = null)
    {
        if (!extension_loaded('curl')) {
            throw new \ErrorException('cURL lib is not loaded');
        }
        $this->_initialize($baseUrl);
    }

    public function setUserAgent($userAgent)
    {
        $this->_userAgent = $userAgent;
        return $this;
    }

    public function simulatePc()
    {
        $this->_userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36';
        return $this;
    }

    public function simulateMobile()
    {
        $this->_userAgent = 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_2 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8H7 Safari/6533.18.5';
        return $this;
    }

    public function setHeaders(array $headers)
    {
        $this->_headers = $headers;
        return $this;
    }

    public function hasHeader( $headerKey ): bool 
    {
        return isset( $this->_headers[$headerKey] );
    }

    public function useHttp2()
    {
        $this->_httpVersion = CURL_HTTP_VERSION_2;
        return $this;
    }

    public function setTimeout(int $timeout)
    {
        $this->_timeout = $timeout;
        return $this;
    }

    private function _initialize($baseUrl)
    {
        $this->setDefaultHttpVersion();
        $this->setDefaultTimeout();
    }

    private  function setDefaultTimeout()
    {
        $this->_timeout = self::DEFAULT_TIMEOUT;
        return $this;
    }

    private  function setDefaultHttpVersion()
    {
        $this->_httpVersion = CURL_HTTP_VERSION_1_1;
        return $this;
    }


    private function request()
    {
    }


    public function get(string $path, array $params = [])
    {
        return $this->request(Method::GET, $path, $params);
    }

    public function post(string $path, $body = [])
    {
        return $this->request(Method::POST, $path, $body);
    }

    public function put(string $path, $body = [])
    {
        return $this->request(Method::PUT, $path, $body);
    }

    public function delete(string $path, array $params = [])
    {
        return $this->request(Method::DELETE, $path, $params);
    }
}

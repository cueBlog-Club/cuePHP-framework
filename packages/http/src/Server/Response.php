<?php

declare(strict_types=1);

namespace CuePhp\Http\Server;

use CuePHp\Http\Server\Request;

/**
 * a HTTP Server response
 * like: { "data":[], "error": {}, "result": 0}
 */
class Response 
{
    /**
     * @var Request
     */
    private $_request ;

    /**
     * @var array
     */
    private $_responseData = [];

    public function __construct( Request $request )
    {
        $this->_request = $request;
    }

    public function setError(  $error )
    {
        $this->_responseData = [];
        $this->_responseData['error'] = $error;
    }

    public function setData( array $data )
    {
        $this->_responseData = $data;
    }

    //TODO
    public function send()
    {
        $this->_setHeaders();
        echo $this->getContent();
    }

    public function getContent()
    {
        return json_encode( $this->_responseData );
    }

    private function _setHeaders()
    {
        header('Content-type:text/json;');
    }

}
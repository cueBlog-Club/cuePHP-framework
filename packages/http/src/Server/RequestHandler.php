<?php

declare(strict_types=1);

namespace CuePhp\Http\Server;

use CuePhp\Http\Server\Request;
use CuePhp\Http\Server\Response;
use Exception;

class RequestHandler
{

    /**
     * @var Request
     */
    private $_request;

    /**
     * @var Response
     */
    private $_response;

    public function __construct( Request $request, Response $response )
    {
        $this->_request = $request;
        $this->_response = $response;
    }

    public function run()
    {
        //TODO
        try{
            $this->_response->setData([]);
        } catch(Exception $e) {
            $this->_response->setError($e);
        }
    }

    public function getResponse(): Response
    {
        return $this->_response;

    }
}
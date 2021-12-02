<?php

declare(strict_types=1);

namespace CuePhp\Http\Server;

use CuePhp\Http\Server\Response;
use CuePhp\Http\Server\Request;
use CuePhp\Http\Server\RequestHandler;


class Server 
{
    /**
     * @var RequestHandler
     */
    private $_requestHandler = null;

    /**
     * @var Request
     */
    private $_request;

    /**
     * @var Response
     */
    private $_response;

    public function __construct()
    {
        $this->_request = new Request($_REQUEST);
        $this->_response = new Response($this->_request);
        $this->_requestHandler = new RequestHandler($this->_request, $this->_response);
    }

    public function listenAndServe()
    {
        $this->_requestHandler->run();
        return $this->_requestHandler->getResponse()->getContent();
    }
}
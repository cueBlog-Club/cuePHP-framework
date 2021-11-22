<?php

namespace CueBlog\Routing\Exception;

class MethodNotAllowedException extends \Exception
{
	public function __construct( string $method , int $code = 403 )
	{
		$message = sprintf( '%s is not allowed' , $method );
		
		parent::__construct( $message , $code );
	}
}
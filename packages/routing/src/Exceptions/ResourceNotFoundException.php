<?php

namespace CueBlog\Routing\Exception;

class ResourceNotFoundException extends \Exception
{
	public function __construct( string $path , int $code = 404 )
	{
		$message = sprintf( '%s is  not found' , $path );
		parent::__construct( $message , $code );
	}
}

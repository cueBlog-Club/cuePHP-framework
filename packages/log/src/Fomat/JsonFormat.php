<?php
namespace SolaTyolo\Lightlog;

use SolaTyolo\Lightlog\Format\AbstractFormat;

class JsonFormat extends AbstractFormat
{
      public function __construct()
      {
          parent::__construct();
      }   

      public function format( array $message ): string
      {
              
      }
}
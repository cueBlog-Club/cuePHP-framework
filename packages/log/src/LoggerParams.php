<?php
namespace SolaTyolo\Lightlog;

use SolaTyolo\Lightlog\IFormat;
use SolaTyolo\Lightlog\IChannel;

/**
 * logger instace params
 */
class LoggerParams
{
    /**
     * log output level
     * @var string
     */
    private $_level = '';
     
    /**
     * log output format
     * @var IFormat
     */
    private $_format = null;

    /**
     * log output channel
     * @var IChannel[]
     */
    private $_channels = [];
}
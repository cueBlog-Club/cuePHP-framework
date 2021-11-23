<?php

namespace SolaTyolo\Lightlog;

use Psr\Log\LogLevel;
use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{

    const LEVEL_NONE = 'none';

    /**
     * log path
     * @var string
     */
    private $logFile = "/tmp/";

    /**
     * level map
     * @ var array
     */
    const LEVELS = [
        self::LEVEL_NONE => 65535,
        LogLevel::DEBUG => 0,
        LogLevel::INFO => 1,
        LogLevel::NOTICE => 2,
        LogLevel::WARNING => 3,
        LogLevel::ERROR => 4,
        LogLevel::CRITICAL => 5,
        LogLevel::ALERT => 6,
        LogLevel::EMERGENCY => 7,
    ];

    /**
     * logger output level
     * @var string
     */
    private $_level = self::LEVELS[self::LEVEL_NONE];

    /**
     * output channels
     * @var array
     */
    private $channels = [];

    protected function __construct( $logLevel )
    {
        // $this->_initLevel($logLevel);
        // $this->_initPath();
    }


    public function log($level, string|\Stringable $message, array $context = []): void
    {
        foreach( $this->channels as $channel ) {
             
        }


    }

    /**
     * System is unusable.
     *
     * @param string|\Stringable $message
     * @param array  $context
     *
     * @return void
     */
    public function emergency(string|\Stringable $message, array $context = []): void
    {
        if ($this->_isOutputLogger(LogLevel::EMERGENCY)) {
            $this->log(LogLevel::EMERGENCY, $message, $context);
        }
    }
    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string|\Stringable $message
     * @param array  $context
     *
     * @return void
     */
    public function alert(string|\Stringable $message, array $context = []): void
    {
        if ($this->_isOutputLogger(LogLevel::ALERT)) {
            $this->log(LogLevel::ALERT, $message, $context);
        }
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string|\Stringable $message
     * @param array  $context
     *
     * @return void
     */
    public function critical(string|\Stringable $message, array $context = []): void
    {
        if ($this->_isOutputLogger(LogLevel::CRITICAL)) {
            $this->log(LogLevel::CRITICAL, $message, $context);
        }
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string|\Stringable $message
     * @param array  $context
     *
     * @return void
     */
    public function error(string|\Stringable $message, array $context = []): void
    {
        if ($this->_isOutputLogger(LogLevel::ERROR)) {
            $this->log(LogLevel::ERROR, $message, $context);
        }
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string|\Stringable $message
     * @param array  $context
     *
     * @return void
     */
    public function warning(string|\Stringable $message, array $context = []): void
    {
        if ($this->_isOutputLogger(LogLevel::WARNING)) {
            $this->log(LogLevel::WARNING, $message, $context);
        }
    }

    /**
     * Normal but significant events.
     *
     * @param string|\Stringable $message
     * @param array  $context
     *
     * @return void
     */
    public function notice(string|\Stringable $message, array $context = []): void
    {
        if ($this->_isOutputLogger(LogLevel::NOTICE)) {
            $this->log(LogLevel::NOTICE, $message, $context);
        }
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string|\Stringable $message
     * @param array  $context
     *
     * @return void
     */
    public function info(string|\Stringable $message, array $context = []): void
    {
        if ($this->_isOutputLogger(LogLevel::INFO)) {
            $this->log(LogLevel::INFO, $message, $context);
        }
    }

    /**
     * Detailed debug information.
     *
     * @param string|\Stringable $message
     * @param array  $context
     *
     * @return void
     */
    public function debug(string|\Stringable $message, array $context = []): void
    {
        if ($this->_isOutputLogger(LogLevel::DEBUG)) {
            $this->log(LogLevel::DEBUG, $message, $context);
        }
    }

    /**
     * confirm whether is  log to output
     */
    private function _isOutputLogger($level): bool
    {
        return $this->_level < self::LEVELS[$level];
    }
}

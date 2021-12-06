<?php

namespace CuePhp\Logger;

use Psr\Log\LogLevel;
use Psr\Log\LoggerInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Logger implements LoggerInterface
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    protected function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function log($level, $message, array $context = array())
    {
        foreach ($this->channels as $channel) {
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
    public function emergency($message, array $context = array())
    {
        $this->writeLog(__FUNCTION__, $message, $context);
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
    public function alert($message, array $context = array())
    {
        $this->writeLog(__FUNCTION__, $message, $context);

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
    public function critical($message, array $context = array())
    {
        $this->writeLog(__FUNCTION__, $message, $context);

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
    public function error($message, array $context = array())
    {
        $this->writeLog(__FUNCTION__, $message, $context);

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
    public function warning($message, array $context = array())
    {
        $this->writeLog(__FUNCTION__, $message, $context);

    }

    /**
     * Normal but significant events.
     *
     * @param string|\Stringable $message
     * @param array  $context
     *
     * @return void
     */
    public function notice($message, array $context = array())
    {
        $this->writeLog(__FUNCTION__, $message, $context);

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
    public function info($message, array $context = array())
    {
        $this->writeLog(__FUNCTION__, $message, $context);

    }

    /**
     * Detailed debug information.
     *
     * @param string|\Stringable $message
     * @param array  $context
     *
     * @return void
     */
    public function debug($message, array $context = array())
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }

    protected function writeLog($level, $message,  $context)
    {
        $this->logger->{$level}(
            $message = $this->formatMessage($message),
            $context = $context
        );
    }

    protected function formatMessage($message)
    {
        if (is_array($message)) {
            return var_export($message, true);
        } elseif ($message instanceof Jsonable) {
            return $message->toJson();
        } elseif ($message instanceof Arrayable) {
            return var_export($message->toArray(), true);
        }

        return $message;
    }

    public function getLogger()
    {
        return $this->logger;
    }

    public function __call($name, $arguments)
    {
        return $this->logger->{$name}(...$arguments);
    }
}

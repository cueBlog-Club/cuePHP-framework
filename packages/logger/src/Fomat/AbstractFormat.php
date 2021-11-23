<?php

namespace SolaTyolo\Lightlog\Format;

use SolaTyolo\Lightlog\Format\IFormat;

abstract class AbstractFormat implements IFormat
{

    public function __construct()
    {
    }

    /**
     * format a log message
     */
    public function format(array $message)
    {
        return $this->write($message);
    }

    /**
     * format batch log message
     */
    public function formatBatch(array $messages)
    {
        foreach ($messages as $key => $message) {
            $messages[$key] = $this->format($message);
        }
        return $messages;
    }

    protected function write($message)
    {
        return $message;
    }
}

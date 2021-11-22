<?php

namespace SolaTyolo\Lightlog\Format;

interface IFormat
{
    /**
     * format a log message
     */
    public function format(array $message);

    /**
     * format batch log message
     */
    public function formatBatch(array $messages);
}

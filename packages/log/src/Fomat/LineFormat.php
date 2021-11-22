<?php

namespace SolaTyolo\Lightlog\Format;

class LineFormat implements
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

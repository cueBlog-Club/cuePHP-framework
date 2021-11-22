<?php

declare(strict_types=1);

namespace SolaTyolo\Lightioc;

interface FuncImpl
{

    public function isLocked();

    public function getKey();
}

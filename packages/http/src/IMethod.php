<?php 
declare(strict_types=1);

namespace CuePhp\Http;

interface IMethod
{
    const GET = 1;

    const POST = 2;

    const PUT = 3;

    const DELETE = 4;

    const HEAD = 5;

    const OPTION = 6;

}
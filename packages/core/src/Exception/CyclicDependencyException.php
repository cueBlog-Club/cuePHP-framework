<?
declare(strict_types=1);

namespace SolaTyolo\Lightioc\Exception;

use Psr\Container\ContainerExceptionInterface;

/**
 * 循环依赖异常
 */
class CyclicDependencyException implements ContainerExceptionInterface 
{

}
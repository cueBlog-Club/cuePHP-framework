<?
declare(strict_types=1);

namespace SolaTyolo\Lightioc\Exception;

use Psr\Container\ContainerExceptionInterface;

/**
 * setter 方法不存在， 用于设置属性
 */
class CyclicDependencyException implements ContainerExceptionInterface 
{

}
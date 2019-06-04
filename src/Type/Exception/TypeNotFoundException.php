<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type\Exception;

use Psr\Container\NotFoundExceptionInterface;

class TypeNotFoundException extends \InvalidArgumentException implements NotFoundExceptionInterface
{
}

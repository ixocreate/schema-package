<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type;

/**
 * Interface TransformableInterface
 *
 * @package Ixocreate\Schema\Package
 */
interface TransformableInterface
{
    public function transform($data): TypeInterface;
}

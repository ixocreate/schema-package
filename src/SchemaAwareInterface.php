<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Schema\Builder\BuilderInterface;

interface SchemaAwareInterface
{
    /**
     * @param BuilderInterface $builder
     * @return SchemaInterface
     */
    public function schema(BuilderInterface $builder): SchemaInterface;
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Schema\Builder\BuilderInterface;

/**
 * Interface SchemaReceiverInterface
 *
 * @package Ixocreate\Schema\Package
 * @deprecated
 */
interface SchemaReceiverInterface
{
    public function receiveSchema(BuilderInterface $builder, array $options = []): SchemaInterface;
}

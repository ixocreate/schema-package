<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

/**
 * Interface SchemaReceiverInterface
 * @package Ixocreate\Schema\Package
 * @deprecated
 */
interface SchemaReceiverInterface
{
    public function receiveSchema(BuilderInterface $builder, array $options = []): SchemaInterface;
}

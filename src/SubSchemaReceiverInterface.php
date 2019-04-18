<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package;

interface SubSchemaReceiverInterface
{
    public function receiveSchema(string $name, BuilderInterface $builder, array $options = []): SchemaInterface;
}

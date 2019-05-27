<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Schema\Builder\BuilderInterface;

interface SubSchemaReceiverInterface
{
    public function receiveSchema(string $name, BuilderInterface $builder, array $options = []): SchemaInterface;
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\SchemaInterface;
use Ixocreate\Schema\Type\CollectionType;
use Ixocreate\Schema\Type\Type;
use Ixocreate\Schema\Type\TypeInterface;

final class TableElement extends AbstractSingleElement
{
    public function type(): string
    {
        return TypeInterface::TYPE_STRING;
    }

    public function inputType(): string
    {
        return 'table';
    }

    public static function serviceName(): string
    {
        return 'table';
    }
}

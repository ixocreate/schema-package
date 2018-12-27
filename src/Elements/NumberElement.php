<?php
/**
 * kiwi-suite/schema (https://github.com/kiwi-suite/schema)
 *
 * @package kiwi-suite/schema
 * @link https://github.com/kiwi-suite/schema
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
namespace Ixocreate\Schema\Elements;

use Ixocreate\Contract\Type\TypeInterface;

final class NumberElement extends AbstractSingleElement
{
    public function type(): string
    {
        return TypeInterface::TYPE_INT;
    }

    public function inputType(): string
    {
        return 'number';
    }

    public static function serviceName(): string
    {
        return 'number';
    }
}

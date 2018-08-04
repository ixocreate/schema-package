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
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Contract\Type\TypeInterface;

final class TextElement extends AbstractSingleElement
{
    public function type(): string
    {
        return TypeInterface::TYPE_STRING;
    }

    public function inputType(): string
    {
        return 'text';
    }

    public static function serviceName(): string
    {
        return 'text';
    }
}

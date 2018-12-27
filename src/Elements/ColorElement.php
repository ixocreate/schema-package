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

use Ixocreate\CommonTypes\Entity\ColorType;

final class ColorElement extends AbstractSingleElement
{
    public function type(): string
    {
        return ColorType::class;
    }

    public function inputType(): string
    {
        return 'color';
    }

    public static function serviceName(): string
    {
        return 'color';
    }
}

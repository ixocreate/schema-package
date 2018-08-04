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

use KiwiSuite\CommonTypes\Entity\DateType;

final class DateElement extends AbstractSingleElement
{
    public function inputType(): string
    {
        return 'date';
    }

    public function type(): string
    {
        return DateType::class;
    }

    public static function serviceName(): string
    {
        return 'date';
    }
}

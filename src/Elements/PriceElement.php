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

use KiwiSuite\CommonTypes\Entity\PriceType;

final class PriceElement extends AbstractSingleElement
{
    public function type(): string
    {
        return PriceType::class;
    }

    public function inputType(): string
    {
        return 'price';
    }

    public static function serviceName(): string
    {
        return 'price';
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['currencies'] = ['EUR', 'USD'];
        $array['decimal'] = 2;

        return $array;
    }
}

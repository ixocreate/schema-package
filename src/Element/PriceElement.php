<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\PriceType;

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

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Schema\Elements;

use Ixocreate\Package\Type\Entity\PriceType;

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

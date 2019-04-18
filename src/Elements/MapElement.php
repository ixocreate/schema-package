<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package\Elements;

use Ixocreate\Type\Package\Entity\MapType;

final class MapElement extends AbstractSingleElement
{
    public function type(): string
    {
        return MapType::class;
    }

    public function inputType(): string
    {
        return 'map';
    }

    public static function serviceName(): string
    {
        return 'map';
    }
}

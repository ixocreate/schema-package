<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package\Elements;

use Ixocreate\Type\Package\Entity\ColorType;

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

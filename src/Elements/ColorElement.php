<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\CommonTypes\Entity\ColorType;

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

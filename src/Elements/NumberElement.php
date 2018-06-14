<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Contract\Type\TypeInterface;

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

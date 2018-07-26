<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Contract\Type\TypeInterface;

final class CheckboxElement extends AbstractSingleElement
{
    public function type(): string
    {
        return TypeInterface::TYPE_BOOL;
    }

    public function inputType(): string
    {
        return 'checkbox';
    }

    public static function serviceName(): string
    {
        return 'checkbox';
    }
}

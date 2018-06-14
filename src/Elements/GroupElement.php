<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Contract\Type\TypeInterface;

final class GroupElement extends AbstractGroup
{

    public function inputType(): string
    {
        return TypeInterface::TYPE_ARRAY;
    }

    public function type(): string
    {
        return 'group';
    }

    public static function serviceName(): string
    {
        return 'group';
    }
}

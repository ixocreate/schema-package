<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\CommonTypes\Entity\SchemaType;
use KiwiSuite\Contract\Schema\StructuralGroupingInterface;

final class GroupElement extends AbstractGroup implements StructuralGroupingInterface
{

    public function inputType(): string
    {
        return SchemaType::class;
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

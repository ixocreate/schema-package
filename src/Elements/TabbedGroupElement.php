<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\CommonTypes\Entity\SchemaType;
use KiwiSuite\Contract\Schema\ElementInterface;
use KiwiSuite\Contract\Schema\SchemaInterface;
use KiwiSuite\Contract\Schema\StructuralGroupingInterface;

final class TabbedGroupElement extends AbstractGroup implements StructuralGroupingInterface
{
    /**
     * @return string
     */
    public function type(): string
    {
        return SchemaType::class;
    }

    /**
     * @return string
     */
    public function inputType(): string
    {
        return 'tabbedGroup';
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'tabbedGroup';
    }

    /**
     * @param ElementInterface $element
     * @return SchemaInterface
     * @throws \Exception
     */
    public function withAddedElement(ElementInterface $element): SchemaInterface
    {
        if (!($element instanceof GroupElement)) {
            throw new \Exception("Element must be a GroupElement");
        }
        return parent::withAddedElement($element);
    }
}

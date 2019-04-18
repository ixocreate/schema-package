<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package\Elements;

use Ixocreate\Type\Package\Entity\SchemaType;
use Ixocreate\Schema\Package\ElementInterface;
use Ixocreate\Schema\Package\SchemaInterface;
use Ixocreate\Schema\Package\StructuralGroupingInterface;

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
     * @throws \Exception
     * @return SchemaInterface
     */
    public function withAddedElement(ElementInterface $element): SchemaInterface
    {
        if (!($element instanceof GroupElement)) {
            throw new \Exception("Element must be a GroupElement");
        }
        return parent::withAddedElement($element);
    }
}

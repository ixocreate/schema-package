<?php
/**
 * kiwi-suite/schema (https://github.com/kiwi-suite/schema)
 *
 * @package kiwi-suite/schema
 * @link https://github.com/kiwi-suite/schema
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
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

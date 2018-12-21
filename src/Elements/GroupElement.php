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
use KiwiSuite\Contract\Schema\StructuralGroupingInterface;

final class GroupElement extends AbstractGroup implements StructuralGroupingInterface
{
    /**
     * @var string|null
     */
    private $icon;

    /**
     * @return string
     */
    public function inputType(): string
    {
        return SchemaType::class;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return 'group';
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'group';
    }

    /**
     * @param string $icon
     * @return GroupElement
     */
    public function withIcon(string $icon): GroupElement
    {
        $group = clone $this;
        $group->icon = $icon;

        return $group;
    }

    /**
     * @return string
     */
    public function icon(): ?string
    {
        return $this->icon;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['icon'] = $this->icon();

        return $array;
    }
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\SchemaType;

final class GroupElement extends AbstractGroup implements StructuralGroupingInterface
{
    /**
     * @var string|null
     */
    private $icon;

    /**
     * @var string
     */
    private $nameExpression = "";

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
     * @param string $nameExpression
     * @return GroupElement
     */
    public function withNameExpression(string $nameExpression): GroupElement
    {
        $group = clone $this;
        $group->nameExpression = $nameExpression;

        return $group;
    }

    /**
     * @return string|null
     */
    public function nameExpression(): string
    {
        return $this->nameExpression;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['icon'] = $this->icon();
        $array['nameExpression'] = $this->nameExpression();

        return $array;
    }
}

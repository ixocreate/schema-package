<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\TypeInterface;

final class SectionElement extends AbstractGroup implements StructuralGroupingInterface
{
    private $icon = "";

    public function type(): string
    {
        return TypeInterface::TYPE_ARRAY;
    }

    public function inputType(): string
    {
        return 'section';
    }

    public static function serviceName(): string
    {
        return 'section';
    }

    public function withIcon(string $icon): SectionElement
    {
        $element = clone $this;
        $element->icon = $icon;

        return $element;
    }

    public function icon(): string
    {
        return $this->icon;
    }

    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['icon'] = $this->icon();

        return $array;
    }
}

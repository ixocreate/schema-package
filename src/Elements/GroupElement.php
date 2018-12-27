<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\CommonTypes\Entity\SchemaType;
use Ixocreate\Contract\Schema\StructuralGroupingInterface;

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

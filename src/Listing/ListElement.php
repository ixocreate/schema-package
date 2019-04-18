<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package\Listing;

use Ixocreate\Schema\Package\Listing\ElementInterface;

/**
 * Class ListElement
 * @package Ixocreate\Schema\Package\Listing
 * @deprecated
 */
final class ListElement implements ElementInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $label;

    /**
     * @var bool
     */
    private $sortable;

    /**
     * @var bool
     */
    private $searchable;

    /**
     * @var string
     */
    private $type;

    /**
     * ListElement constructor.
     * @param string $name
     * @param string $label
     * @param bool $sortable
     * @param bool $searchable
     * @param string $type
     */
    public function __construct(
        string $name,
        string $label,
        bool $sortable = true,
        bool $searchable = true,
        string $type = "string"
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->sortable = $sortable;
        $this->searchable = $searchable;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function label(): string
    {
        return $this->label;
    }

    /**
     * @return bool
     */
    public function sortable(): bool
    {
        return $this->sortable;
    }

    /**
     * @return bool
     */
    public function searchable(): bool
    {
        return $this->searchable;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'sortable' => $this->sortable,
            'searchable' => $this->searchable,
            'type' => $this->type,
        ];
    }
}

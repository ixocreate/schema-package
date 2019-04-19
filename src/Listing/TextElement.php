<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Listing;

final class TextElement implements ElementInterface
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
     * ListElement constructor.
     *
     * @param string $name
     * @param string $label
     * @param bool $sortable
     * @param bool $searchable
     */
    public function __construct(
        string $name,
        string $label,
        bool $sortable = true,
        bool $searchable = true
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->sortable = $sortable;
        $this->searchable = $searchable;
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
        return 'string';
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name(),
            'label' => $this->label(),
            'sortable' => $this->sortable(),
            'searchable' => $this->searchable(),
            'type' => $this->type(),
            'options' => [],
        ];
    }
}

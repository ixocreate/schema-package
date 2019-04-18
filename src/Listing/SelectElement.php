<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package\Listing;

use Ixocreate\Schema\Package\Listing\ElementInterface;

final class SelectElement implements ElementInterface
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
     * @var array
     */
    private $flags = [];

    /**
     * ListElement constructor.
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
        return 'select';
    }

    /**
     * @return array
     */
    public function flags(): array
    {
        return $this->flags;
    }

    /**
     * @param string $name
     * @param string $label
     * @param string $color
     * @return SelectElement
     */
    public function withAddedFlag(string $name, string $label, string $color): SelectElement
    {
        $element = clone $this;
        $element->flags[$name]['color'] = $color;
        $element->flags[$name]['label'] = $label;

        return $element;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $options = [
            'values' => [],
            'colors' => [],
        ];

        foreach ($this->flags() as $name => $data) {
            $options['values'][$name] = $data['label'];
            $options['colors'][$name] = $data['color'];
        }

        return [
            'name' => $this->name(),
            'label' => $this->label(),
            'sortable' => $this->sortable(),
            'searchable' => $this->searchable(),
            'type' => $this->type(),
            'options' => $options,
        ];
    }
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package\Listing;

final class CheckboxElement implements ElementInterface
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
    private $flags = [
        'true' => [
            'label' => 'yes',
            'color' => 'success',
        ],
        'false' => [
            'label' => 'no',
            'color' => 'danger',
        ],
    ];

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
        return 'bool';
    }

    /**
     * @return array
     */
    public function flags(): array
    {
        return $this->flags;
    }

    /**
     * @param string $color
     * @return CheckboxElement
     */
    public function withTrueColor(string $color): CheckboxElement
    {
        $element = clone $this;
        $element->flags['true']['color'] = $color;

        return $element;
    }

    /**
     * @param string $color
     * @return CheckboxElement
     */
    public function withFalseColor(string $color): CheckboxElement
    {
        $element = clone $this;
        $element->flags['false']['color'] = $color;

        return $element;
    }

    /**
     * @param string $label
     * @return CheckboxElement
     */
    public function withTrueLabel(string $label): CheckboxElement
    {
        $element = clone $this;
        $element->flags['true']['label'] = $label;

        return $element;
    }

    /**
     * @param string $label
     * @return CheckboxElement
     */
    public function withFalseLabel(string $label): CheckboxElement
    {
        $element = clone $this;
        $element->flags['false']['label'] = $label;

        return $element;
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
            'options' => [
                'values' => [
                    'true' => $this->flags()['true']['label'],
                    'false' => $this->flags()['false']['label'],
                ],
                'colors' => [
                    'true' => $this->flags()['true']['color'],
                    'false' => $this->flags()['false']['color'],
                ],
            ],
        ];
    }
}

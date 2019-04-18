<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Schema\Elements;

use Ixocreate\Package\Type\TypeInterface;

final class MultiSelectElement extends AbstractSingleElement
{
    /**
     * @var array
     */
    private $options = [];

    /**
     * @var null
     */
    private $resource = null;

    /**
     * @var bool
     */
    private $extendedSelect = false;

    /**
     * @return string
     */
    public function type(): string
    {
        return TypeInterface::TYPE_ARRAY;
    }

    /**
     * @return string
     */
    public function inputType(): string
    {
        return 'multiselect';
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'multiselect';
    }

    /**
     * @return array
     */
    public function options(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return MultiSelectElement
     */
    public function withOptions(array $options): MultiSelectElement
    {
        $element = clone $this;
        $element->options = $options;

        return $element;
    }

    /**
     * @return array|null
     */
    public function resource(): ?array
    {
        return $this->resource;
    }

    /**
     * @param string $resource
     * @param string $value
     * @param string $label
     * @return MultiSelectElement
     */
    public function withResource(string $resource, string $value, string $label): MultiSelectElement
    {
        $element = clone $this;
        $element->resource = [
            'resource' => $resource,
            'value' => $value,
            'label' => $label,
        ];

        return $element;
    }

    /**
     * @return bool
     */
    public function extendedSelect(): bool
    {
        return $this->extendedSelect;
    }

    /**
     * @param bool $extendedSelect
     * @return MultiSelectElement
     */
    public function withExtendedSelect(bool $extendedSelect): MultiSelectElement
    {
        $element = clone $this;
        $element->extendedSelect = $extendedSelect;

        return $element;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['options'] = $this->options();
        $array['resource'] = $this->resource();
        $array['extendedSelect'] = $this->extendedSelect();

        return $array;
    }
}

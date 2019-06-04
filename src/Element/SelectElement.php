<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\TypeInterface;

final class SelectElement extends AbstractSingleElement
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
        return TypeInterface::TYPE_STRING;
    }

    /**
     * @return string
     */
    public function inputType(): string
    {
        return 'select';
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'select';
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
     * @return SelectElement
     */
    public function withOptions(array $options): SelectElement
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
     * @return SelectElement
     */
    public function withResource(string $resource, string $value, string $label): SelectElement
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
     * @return SelectElement
     */
    public function withExtendedSelect(bool $extendedSelect): SelectElement
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

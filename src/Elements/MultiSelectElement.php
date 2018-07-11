<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Contract\Type\TypeInterface;

final class MultiSelectElement extends AbstractSingleElement
{
    private $options = [];

    /**
     * @var null
     */
    private $resource = null;

    public function type(): string
    {
        return TypeInterface::TYPE_ARRAY;
    }

    public function inputType(): string
    {
        return 'multiselect';
    }

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

    public function withOptions(array $options): MultiSelectElement
    {
        $element = clone $this;
        $element->options = $options;

        return $element;
    }

    public function resource(): ?array
    {
        return $this->resource;
    }

    public function withResource(string $resource, string $value, string $label): MultiSelectElement
    {
        $element = clone $this;
        $element->resource = [
            'resource' => $resource,
            'value' => $value,
            'label' => $label
        ];

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

        return $array;
    }
}

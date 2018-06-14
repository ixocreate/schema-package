<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Contract\Type\TypeInterface;

final class MultiCheckboxElement extends AbstractSingleElement
{
    private $options = [];

    public function type(): string
    {
        return TypeInterface::TYPE_STRING;
    }

    public function inputType(): string
    {
        return 'multiCheckbox';
    }

    /**
     * @return array
     */
    public function options(): array
    {
        return $this->options;
    }

    public function withOptions(array $options): SelectElement
    {
        $element = clone $this;
        $element->options = $options;

        return $element;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['options'] = $this->options();

        return $array;
    }

    public static function serviceName(): string
    {
        return 'multiCheckbox';
    }
}

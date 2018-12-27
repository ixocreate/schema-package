<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\Contract\Type\TypeInterface;

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

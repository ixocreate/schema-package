<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Type\TypeInterface;

final class RadioElement extends AbstractSingleElement
{
    private $options = [];

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
        return 'radio';
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'radio';
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
     * @return RadioElement
     */
    public function withOptions(array $options): RadioElement
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
}

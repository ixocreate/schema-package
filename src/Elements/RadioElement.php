<?php
/**
 * kiwi-suite/schema (https://github.com/kiwi-suite/schema)
 *
 * @package kiwi-suite/schema
 * @link https://github.com/kiwi-suite/schema
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Contract\Type\TypeInterface;

final class RadioElement extends AbstractSingleElement
{
    private $options = [];

    public function type(): string
    {
        return TypeInterface::TYPE_STRING;
    }

    public function inputType(): string
    {
        return 'radio';
    }

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

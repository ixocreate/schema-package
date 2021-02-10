<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

abstract class AbstractTextElement extends AbstractSingleElement
{
    /** @var bool */
    protected $characterCount = false;

    /** @var array */
    protected $characterBoundaries = null;

    /**
     * @return bool
     */
    public function characterCount(): bool
    {
        return $this->characterCount;
    }

    public function withCharacterCount(bool $characterCount): AbstractTextElement
    {
        $element = clone $this;
        $element->characterCount = $characterCount;

        return $element;
    }

    /**
     * @return array
     */
    public function characterBoundaries(): ?array
    {
        return $this->characterBoundaries;
    }

    public function withCharacterBoundaries(?int $min, ?int $max): AbstractTextElement
    {
        $element = clone $this;
        $element->characterBoundaries = [
            'min' => $min,
            'max' => $max,
        ];

        return $element;
    }

    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['characterCount'] = $this->characterCount;
        $array['characterBoundaries'] = $this->characterBoundaries;

        return $array;
    }
}

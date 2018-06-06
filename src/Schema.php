<?php
namespace KiwiSuite\Schema;

final class Schema implements \JsonSerializable
{
    /**
     * @var array
     */
    private $elements = [];

    /**
     * @param array $elements
     * @return Schema
     */
    public function withElements(array $elements): Schema
    {
        $schema = clone $this;
        $schema->elements = $elements;

        return $schema;
    }

    /**
     * @param ElementInterface $element
     * @return Schema
     */
    public function withAddedElement(ElementInterface $element): Schema
    {
        $schema = clone $this;
        $schema->elements[$element->name()] = $element;

        return $schema;
    }

    /**
     * @return array
     */
    public function elements(): array
    {
        return $this->elements;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_values($this->elements);
    }
}

<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Schema\ElementInterface;
use KiwiSuite\Schema\GroupInterface;

abstract class AbstractGroup extends AbstractElement implements GroupInterface
{
    /**
     * @var ElementInterface[]
     */
    protected $elements = [];

    /**
     * @return ElementInterface[]
     */
    public function elements(): array
    {
        return $this->elements;
    }

    /**
     * @param string $name
     * @return ElementInterface
     */
    public function get(string $name): ElementInterface
    {
        return $this->elements[$name];
    }

    /**
     * @param string $name
     * @return GroupInterface
     */
    public function remove(string $name): GroupInterface
    {
        $group = clone $this;

        if (!\array_key_exists($name, $group->elements)) {
            return $group;
        }

        unset($group->elements[$name]);

        return $group;
    }

    /**
     * @param array $elements
     * @return ElementInterface
     */
    public function withElements(array $elements): ElementInterface
    {
        $group = clone $this;
        $group->elements = $elements;

        return $group;
    }

    /**
     * @param ElementInterface $element
     * @return ElementInterface
     */
    public function withAddedElement(ElementInterface $element): ElementInterface
    {
        $group = clone $this;
        $group->elements[$element->name()] = $element;

        return $group;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['elements'] = array_values($this->elements);

        return $array;
    }
}

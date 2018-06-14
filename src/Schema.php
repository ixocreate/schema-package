<?php
namespace KiwiSuite\Schema;

use KiwiSuite\CommonTypes\Entity\SchemaType;
use KiwiSuite\Contract\Schema\ElementInterface;
use KiwiSuite\Contract\Schema\SchemaInterface;
use KiwiSuite\Contract\Schema\TransformableInterface;
use KiwiSuite\Contract\Type\TypeInterface;
use KiwiSuite\Entity\Type\Type;

final class Schema implements SchemaInterface, TransformableInterface
{
    /**
     * @var ElementInterface[]
     */
    private $elements = [];

    /**
     * @param array $elements
     * @return SchemaInterface
     */
    public function withElements(array $elements): SchemaInterface
    {
        $schema = $this;
        foreach ($elements as $element) {
            $schema = $schema->withAddedElement($element);
        }

        return $schema;
    }

    /**
     * @param ElementInterface $element
     * @return SchemaInterface
     */
    public function withAddedElement(ElementInterface $element): SchemaInterface
    {
        $schema = clone $this;
        $schema->elements[$element->name()] = $element;

        return $schema;
    }
    /**
     * @param string $name
     * @return SchemaInterface
     */
    public function remove(string $name): SchemaInterface
    {
        $schema = clone $this;

        if (!\array_key_exists($name, $schema->elements)) {
            return $schema;
        }

        unset($schema->elements[$name]);

        return $schema;
    }


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
     * @return bool
     */
    public function has(string $name): bool
    {
        return \array_key_exists($name, $this->elements);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_values($this->elements);
    }


    public function transform($data): TypeInterface
    {
        return Type::create($data, SchemaType::class, ['schema' => $this]);
    }
}

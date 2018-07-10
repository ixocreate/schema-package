<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\CommonTypes\Entity\SchemaType;
use KiwiSuite\Contract\Schema\ElementInterface;
use KiwiSuite\Contract\Schema\GroupInterface;
use KiwiSuite\Contract\Schema\SchemaInterface;
use KiwiSuite\Contract\Schema\SchemaReceiverInterface;
use KiwiSuite\Contract\Schema\StructuralGroupingInterface;
use KiwiSuite\Contract\Schema\TransformableInterface;
use KiwiSuite\Contract\Type\TypeInterface;
use KiwiSuite\Entity\Type\Type;

abstract class AbstractGroup extends AbstractElement implements GroupInterface, TransformableInterface
{
    /**
     * @var ElementInterface[]
     */
    protected $elements = [];

    /**
     * @var SchemaReceiverInterface|null
     */
    protected $schemaReceiver;

    /**
     * @return ElementInterface[]
     */
    public function elements(): array
    {
        return $this->elements;
    }

    /**
     * @return ElementInterface[]
     */
    public function all(): array
    {
        $elements = [];

        foreach ($this->elements() as $name => $element) {
            if (!($element instanceof StructuralGroupingInterface)) {
                $elements[$name] = $element;
                continue;
            }

            foreach ($element->all() as $innerName => $innerElement) {
                $elements[$innerName] = $innerElement;
            }
        }
        return $elements;
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
     * @return SchemaInterface
     */
    public function remove(string $name): SchemaInterface
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
     * @return SchemaInterface
     */
    public function withElements(array $elements): SchemaInterface
    {
        $group = $this;
        foreach ($elements as $element) {
            $group = $group->withAddedElement($element);
        }

        return $group;
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
     * @param ElementInterface $element
     * @return SchemaInterface
     */
    public function withAddedElement(ElementInterface $element): SchemaInterface
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
        $array['elements'] = array_values($this->elements());

        return $array;
    }

    public function transform($data): TypeInterface
    {
        return Type::create($data, SchemaType::class, ['schema' => $this]);
    }

    public function withSchemaReceiver(SchemaReceiverInterface $schemaReceiver): SchemaInterface
    {
        $group = clone $this;
        $group->schemaReceiver = $schemaReceiver;

        return $group;
    }

    public function schemaReceiver(): ? SchemaReceiverInterface
    {
        return $this->schemaReceiver;
    }


}

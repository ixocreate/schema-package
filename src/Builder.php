<?php
namespace KiwiSuite\Schema;

use KiwiSuite\Contract\Schema\ElementInterface;
use KiwiSuite\Contract\Schema\GroupInterface;
use KiwiSuite\Contract\Type\SchemaElementInterface;
use KiwiSuite\Contract\Type\TypeInterface;
use KiwiSuite\Entity\Entity\Definition;
use KiwiSuite\Entity\Entity\DefinitionCollection;
use KiwiSuite\Entity\Type\Type;
use KiwiSuite\Entity\Type\TypeSubManager;
use KiwiSuite\Schema\Elements\TextElement;

final class Builder
{
    /**
     * @var ElementSubManager
     */
    private $elementSubManager;
    /**
     * @var TypeSubManager
     */
    private $typeSubManager;

    /**
     * Builder constructor.
     * @param ElementSubManager $elementSubManager
     */
    public function __construct(ElementSubManager $elementSubManager, TypeSubManager $typeSubManager)
    {
        $this->elementSubManager = $elementSubManager;
        $this->typeSubManager = $typeSubManager;
    }

    /**
     * @param string $element
     * @param string $name
     * @return ElementInterface
     */
    public function create(string $element, string $name): ElementInterface
    {
        /** @var ElementInterface $element */
        $element = $this->elementSubManager->get($element);
        return $element->withName($name);
    }

    /**
     * @param string $element
     * @param ElementInterface $original
     * @return ElementInterface
     */
    public function recreate(string $element, ElementInterface $original): ElementInterface
    {
        /** @var ElementInterface $element */
        $element = $this->elementSubManager->get($element);

        $element = $element->withName($original->name());
        $element = $element->withLabel($original->label());
        $element = $element->withMetadata($original->metadata());

        if ($original instanceof GroupInterface && $element instanceof GroupInterface) {
            $element = $element->withElements($original->elements());
        }

        return $element;
    }

    /**
     * @param string $entity
     * @return Schema
     */
    public function fromEntity(string $entity): Schema
    {
        $schema = new Schema();
        /** @var DefinitionCollection $definitions */
        $definitions = $entity::getDefinitions();

        /** @var Definition $definition */
        foreach ($definitions as $definition) {
            if (in_array($definition->getName(), ['id', 'createdAt', 'updatedAt'])) {
                continue;
            }
            if ($this->typeSubManager->has($definition->getType())) {
                /** @var TypeInterface $type */
                $type = $this->typeSubManager->get($definition->getType());
                if ($type instanceof SchemaElementInterface) {
                    /** @var ElementInterface $element */
                    $element = $type->schemaElement($this->elementSubManager);
                    $element = $element->withName($definition->getName())
                        ->withLabel(ucfirst($definition->getName()));

                    $schema = $schema->withAddedElement($element);

                    continue;
                }
            }

            /** @var ElementInterface $element */
            $element = $this->create(TextElement::class, $definition->getName());
            $element = $element->withLabel(ucfirst($definition->getName()));

            $schema = $schema->withAddedElement($element);
        }

        return $schema;
    }
}

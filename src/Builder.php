<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package;

use Ixocreate\Type\Package\TypeInterface;
use Ixocreate\Entity\Package\Definition;
use Ixocreate\Entity\Package\DefinitionCollection;
use Ixocreate\Entity\Package\Type\TypeSubManager;
use Ixocreate\Schema\Package\Elements\TextElement;

final class Builder implements BuilderInterface
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
     * @param TypeSubManager $typeSubManager
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
        return $this->get($element)->withName($name);
    }

    /**
     * @param string $element
     * @return ElementInterface
     */
    public function get(string $element): ElementInterface
    {
        return $this->elementSubManager->get($element);
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
            if (\in_array($definition->getName(), ['id', 'createdAt', 'updatedAt'])) {
                continue;
            }
            if ($this->typeSubManager->has($definition->getType())) {
                /** @var TypeInterface $type */
                $type = $this->typeSubManager->get($definition->getType());
                if ($type instanceof ElementProviderInterface) {
                    /** @var ElementInterface $element */
                    $element = $type->provideElement($this);
                    $element = $element->withName($definition->getName())
                        ->withLabel(\ucfirst($definition->getName()));

                    $schema = $schema->withAddedElement($element);

                    continue;
                }
            }

            /** @var ElementInterface $element */
            $element = $this->create(TextElement::class, $definition->getName());
            $element = $element->withLabel(\ucfirst($definition->getName()));

            $schema = $schema->withAddedElement($element);
        }

        return $schema;
    }
}

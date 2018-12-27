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
namespace Ixocreate\Schema;

use Ixocreate\Contract\Schema\BuilderInterface;
use Ixocreate\Contract\Schema\ElementInterface;
use Ixocreate\Contract\Schema\GroupInterface;
use Ixocreate\Contract\Type\SchemaElementInterface;
use Ixocreate\Contract\Type\TypeInterface;
use Ixocreate\Entity\Entity\Definition;
use Ixocreate\Entity\Entity\DefinitionCollection;
use Ixocreate\Entity\Type\TypeSubManager;
use Ixocreate\Schema\Elements\TextElement;

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
            if (\in_array($definition->getName(), ['id', 'createdAt', 'updatedAt'])) {
                continue;
            }
            if ($this->typeSubManager->has($definition->getType())) {
                /** @var TypeInterface $type */
                $type = $this->typeSubManager->get($definition->getType());
                if ($type instanceof SchemaElementInterface) {
                    /** @var ElementInterface $element */
                    $element = $type->schemaElement($this->elementSubManager);
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

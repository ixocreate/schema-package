<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Builder;

use Doctrine\Instantiator\Instantiator;
use Ixocreate\Schema\Element\ElementInterface;
use Ixocreate\Schema\Element\ElementSubManager;
use Ixocreate\Schema\Element\GroupInterface;
use Ixocreate\Schema\SchemaAwareInterface;
use Ixocreate\Schema\SchemaInterface;

final class Builder implements BuilderInterface
{
    /**
     * @var ElementSubManager
     */
    private $elementSubManager;

    /**
     * Builder constructor.
     *
     * @param ElementSubManager $elementSubManager
     */
    public function __construct(ElementSubManager $elementSubManager)
    {
        $this->elementSubManager = $elementSubManager;
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
     * @param string $entityClass
     * @throws \Doctrine\Instantiator\Exception\ExceptionInterface
     * @return SchemaInterface
     * @deprecated
     */
    public function fromEntity(string $entityClass): SchemaInterface
    {
        $instantiator = new Instantiator();
        /** @var SchemaAwareInterface $obj */
        $obj = $instantiator->instantiate($entityClass);

        return $obj->schema($this);
    }
}

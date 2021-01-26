<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Element;

use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\SchemaInterface;
use Ixocreate\Schema\Type\CollectionType;
use Ixocreate\Schema\Type\Type;
use Ixocreate\Schema\Type\TypeInterface;

final class CollectionElement extends AbstractGroup
{
    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * @var null
     */
    protected $limit = null;

    /**
     * CollectionElement constructor.
     *
     * @param BuilderInterface $builder
     */
    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return CollectionType::class;
    }

    /**
     * @return string
     */
    public function inputType(): string
    {
        return 'collection';
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'collection';
    }

    public function transform($data): TypeInterface
    {
        return Type::create($data, CollectionType::class, ['schema' => $this]);
    }

    /**
     * @param ElementInterface $element
     * @throws \Exception
     * @return SchemaInterface
     */
    public function withAddedElement(ElementInterface $element): SchemaInterface
    {
        if (!($element instanceof GroupElement)) {
            throw new \Exception('Element must be a GroupElement');
        }
        return parent::withAddedElement($element);
    }

    /**
     * @return int|null
     */
    public function limit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param int|null $limit
     * @return CollectionElement
     */
    public function withLimit(?int $limit): CollectionElement
    {
        $group = $this;
        $group->limit = $limit;

        return $group;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        $array['limit'] = $this->limit();

        return $array;
    }

    /**
     * @param string $name
     * @param string $label
     * @param SchemaInterface $schema
     * @throws \Exception
     * @return CollectionElement
     */
    public function addCollectionElement(string $name, string $label, SchemaInterface $schema): CollectionElement
    {
        $group = $this->builder->create(GroupElement::class, $name);
        $group = $group->withLabel($label);
        $group = $group->withElements($schema->elements());
        return $this->withAddedElement($group);
    }
}

<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\CommonTypes\Entity\CollectionType;
use KiwiSuite\Contract\Schema\ElementInterface;
use KiwiSuite\Contract\Schema\SchemaInterface;
use KiwiSuite\Contract\Schema\TransformableInterface;
use KiwiSuite\Contract\Type\TypeInterface;
use KiwiSuite\Entity\Type\Type;
use KiwiSuite\Schema\Builder;

final class CollectionElement extends AbstractGroup implements TransformableInterface
{
    /**
     * @var Builder
     */
    private $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function type(): string
    {
        return CollectionType::class;
    }

    public function inputType(): string
    {
        return 'collection';
    }

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
     * @return SchemaInterface
     * @throws \Exception
     */
    public function withAddedElement(ElementInterface $element): SchemaInterface
    {
        if (!($element instanceof GroupElement)) {
            throw new \Exception("Element must be a GroupElement");
        }
        return parent::withAddedElement($element);
    }

    public function addCollectionElement(string $name, string $label, SchemaInterface $schema): CollectionElement
    {
        $group = $this->builder->create(GroupElement::class, $name);
        $group = $group->withLabel($label);
        $group = $group->withElements($schema->elements());
        return $this->withAddedElement($group);
    }
}

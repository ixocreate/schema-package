<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\CommonTypes\Entity\CollectionType;
use Ixocreate\Contract\Schema\ElementInterface;
use Ixocreate\Contract\Schema\SchemaInterface;
use Ixocreate\Contract\Schema\TransformableInterface;
use Ixocreate\Contract\Type\TypeInterface;
use Ixocreate\Entity\Type\Type;
use Ixocreate\Schema\Builder;

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
     * @throws \Exception
     * @return SchemaInterface
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

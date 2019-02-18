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
use Ixocreate\Contract\Type\TransformableInterface;
use Ixocreate\Contract\Type\TypeInterface;
use Ixocreate\Entity\Type\Type;
use Ixocreate\Schema\Builder;

final class CollectionElement extends AbstractGroup implements TransformableInterface
{
    /**
     * @var Builder
     */
    private $builder;

    /**
     * @var null
     */
    protected $limit = null;

    /**
     * CollectionElement constructor.
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
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
            throw new \Exception("Element must be a GroupElement");
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
     * @return CollectionElement
     * @throws \Exception
     */
    public function addCollectionElement(string $name, string $label, SchemaInterface $schema): CollectionElement
    {
        $group = $this->builder->create(GroupElement::class, $name);
        $group = $group->withLabel($label);
        $group = $group->withElements($schema->elements());
        return $this->withAddedElement($group);
    }
}

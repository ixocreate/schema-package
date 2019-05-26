<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type;

use Doctrine\DBAL\Types\JsonType;
use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\Element\ElementInterface;
use Ixocreate\Schema\Element\ElementProviderInterface;
use Ixocreate\Schema\Element\LinkElement;
use Ixocreate\Schema\Link\LinkInterface;
use Ixocreate\Schema\Link\LinkManager;

final class LinkType extends AbstractType implements DatabaseTypeInterface, ElementProviderInterface
{
    /**
     * @var LinkManager
     */
    private $linkManager;

    /**
     * LinkType constructor.
     * @param LinkManager $linkManager
     */
    public function __construct(
        LinkManager $linkManager
    ) {
        $this->linkManager = $linkManager;
    }

    /**
     * @param $value
     * @return mixed
     */
    protected function transform($value)
    {
        if (!\is_array($value)) {
            return [];
        }

        if (empty($value['type'])) {
            return [];
        }

        if ($this->linkManager->has($value['type'])) {
            $value['value'] = $this->linkManager->get($value['type'])->create($value['value']);
        }

        $target = "_self";
        if (\array_key_exists('target', $value) && \in_array($value['target'], ['_self', '_blank'])) {
            $target = $value['target'];
        }

        $value['target'] = $target;

        return [
            'type' => $value['type'],
            'target' => $value['target'],
            'value' => $value['value'],
        ];
    }

    /**
     * @return string|null
     */
    public function type(): ?string
    {
        $array = $this->value();

        if (empty($array)) {
            return null;
        }

        return $array['type'];
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type();
    }

    /**
     * @return string
     */
    public function target(): string
    {
        $array = $this->value();

        if (empty($array)) {
            return '_self';
        }

        return $array['target'];
    }

    /**
     * @return string
     * @deprecated
     */
    public function getTarget(): string
    {
        return $this->target();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $array = $this->value();

        if (empty($array)) {
            return "";
        }

        if (!($array['value'] instanceof LinkInterface)) {
            return "";
        }

        return $array['value']->assemble();
    }

    /**
     * @return mixed|string
     */
    public function jsonSerialize()
    {
        $array = $this->value();

        if (empty($array)) {
            return [
                'value' => null,
                'link' => null,
            ];
        }

        $result = [
            'type' => $array['type'],
            'target' => $array['target'],
            'value' => null,
            'link' => null,
        ];

        if ($array['value'] instanceof LinkInterface) {
            $result['value'] = $array['value']->toJson();
            $result['link'] = $array['value']->assemble();
        }

        return $result;
    }

    /**
     * @return array
     */
    public function convertToDatabaseValue()
    {
        $array = $this->value();

        if (empty($array) || empty($array['type'])) {
            return null;
        }

        $result = [
            'type' => $array['type'],
            'target' => $array['target'],
            'value' => null,
        ];

        if ($array['value'] instanceof LinkInterface) {
            $result['value'] = $array['value']->toDatabase();
        }

        return $result;
    }

    /**
     * @return string
     */
    public static function baseDatabaseType(): string
    {
        return JsonType::class;
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'link';
    }

    /**
     * @param BuilderInterface $builder
     * @return ElementInterface
     */
    public function provideElement(BuilderInterface $builder): ElementInterface
    {
        return $builder->get(LinkElement::class);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        /** @var LinkType $type */
        $type = Type::get(LinkType::serviceName());
        $this->linkManager = $type->linkManager;

        parent::unserialize($serialized);

        $this->value = $this->transform($this->value);
    }
}

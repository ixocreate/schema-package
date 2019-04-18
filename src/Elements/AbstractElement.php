<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\Schema\ElementInterface;

abstract class AbstractElement implements ElementInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $metadata = [];

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function label(): ?string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function metadata(): array
    {
        return $this->metadata;
    }

    /**
     * @param string $name
     * @return ElementInterface
     */
    public function withName(string $name): ElementInterface
    {
        $element = clone $this;
        $element->name = $name;

        return $element;
    }

    /**
     * @param string $label
     * @return ElementInterface
     */
    public function withLabel(string $label): ElementInterface
    {
        $element = clone $this;
        $element->label = $label;

        return $element;
    }

    /**
     * @param string $description
     * @return ElementInterface
     */
    public function withDescription(string $description): ElementInterface
    {
        $element = clone $this;
        $element->description = $description;

        return $element;
    }

    /**
     * @param array $metadata
     * @return ElementInterface
     */
    public function withMetadata(array $metadata): ElementInterface
    {
        $element = clone $this;
        $element->metadata = $metadata;

        return $element;
    }

    /**
     * @param string $key
     * @param $value
     * @return ElementInterface
     */
    public function withAddedMetadata(string $key, $value): ElementInterface
    {
        $element = clone $this;
        $element->metadata[$key] = $value;

        return $element;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'service' => $this->serviceName(),
            'inputType' => $this->inputType(),
            'type' => $this->type(),
            'name' => $this->name(),
            'label' => $this->label(),
            'description' => $this->description(),
            'metadata' => $this->metadata(),
        ];
    }
}

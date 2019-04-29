<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Listing;

final class MediaElement implements ElementInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $label;

    /**
     * ListElement constructor.
     *
     * @param string $name
     * @param string $label
     */
    public function __construct(
        string $name,
        string $label
    ) {
        $this->name = $name;
        $this->label = $label;
    }

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
    public function label(): string
    {
        return $this->label;
    }

    /**
     * @return bool
     */
    public function sortable(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function searchable(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return 'media';
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name(),
            'label' => $this->label(),
            'sortable' => $this->sortable(),
            'searchable' => $this->searchable(),
            'type' => $this->type(),
            'options' => [],
        ];
    }
}

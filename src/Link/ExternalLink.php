<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Link;

final class ExternalLink implements LinkInterface
{
    /**
     * @var null|string
     */
    private $link = null;

    /**
     * @param $value
     * @return LinkInterface
     */
    public function create($value): LinkInterface
    {
        $clone = clone $this;

        if ($value instanceof ExternalLink) {
            $clone->link = $value->link;
        } elseif (\is_string($value)) {
            $clone->link = $value;
        }

        return $clone;
    }

    /**
     * @return string
     */
    public function label(): string
    {
        return "External";
    }

    /**
     * @return string
     */
    public function assemble(): string
    {
        if (empty($this->link)) {
            return "";
        }

        return $this->link;
    }

    public static function serviceName(): string
    {
        return "external";
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return \serialize($this->link);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $this->link = \unserialize($serialized);
    }

    /**
     * @return mixed
     */
    public function toJson()
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function toDatabase()
    {
        return $this->link;
    }
}

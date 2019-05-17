<?php
declare(strict_types=1);

namespace Ixocreate\Schema\Link;

final class ExternalLink implements LinkInterface
{
    /**
     * @var null|string
     */
    private $link;

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
        return "external";
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
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return \serialize($this->link);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $this->link = \unserialize($serialized);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->link;
    }
}

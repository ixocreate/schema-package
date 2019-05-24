<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Entity;

use Ixocreate\Entity\DefinitionCollection;
use Ixocreate\Entity\EntityInterface;
use Ixocreate\Entity\EntityTrait;
use Ixocreate\Entity\Exception\InvalidPropertyException;
use Ixocreate\Schema\Type\Type;

/**
 * TODO: remove this as it's just a temporary construct - schema should have no dependencies on entity
 */
final class Schema implements EntityInterface
{
    use EntityTrait;

    private $schemaProperties = [];

    public function __construct(array $data, DefinitionCollection $definitionCollection)
    {
        self::$definitionCollection = $definitionCollection;
        $this->applyData($data);
    }

    protected static function createDefinitions(): DefinitionCollection
    {
        return self::$definitionCollection;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    private function setValue(string $name, $value): void
    {
        if ($value === null && self::getDefinitions()->get($name)->isNullAble()) {
            $this->schemaProperties[$name] = null;
            return;
        }
        $this->schemaProperties[$name] = Type::create(
            $value,
            self::getDefinitions()->get($name)->getType(),
            self::getDefinitions()->get($name)->getOptions()
        );
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->schemaProperties[$name]);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if (!self::getDefinitions()->has($name)) {
            throw new InvalidPropertyException(
                \sprintf("Invalid property '%s' in '%s'", $name, \get_class($this))
            );
        }

        return $this->schemaProperties[$name];
    }
}

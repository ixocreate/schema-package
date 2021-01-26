<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Type;

use Ixocreate\Schema\Type\Exception\InvalidTypeException;
use Ixocreate\Schema\Type\Exception\TypeNotCreatedException;
use Ixocreate\Schema\Type\Exception\TypeNotFoundException;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;

final class Type
{
    /**
     * @var Type
     */
    private static $type;

    /**
     * @var SubManagerInterface
     */
    private $subManager;

    /**
     * @param SubManagerInterface|null $subManager
     */
    private function __construct(SubManagerInterface $subManager = null)
    {
        $this->subManager = $subManager;
    }

    /**
     * @param SubManagerInterface|null $subManager
     */
    public static function initialize(SubManagerInterface $subManager = null)
    {
        self::$type = new Type($subManager);
    }

    /**
     * @return Type
     */
    private static function getInstance(): Type
    {
        if (!(self::$type instanceof Type)) {
            self::initialize();
        }

        return self::$type;
    }

    /**
     * @param $value
     * @param string $type
     * @param array $options
     * @return mixed
     */
    public static function create($value, string $type, array $options = [])
    {
        return self::getInstance()->doCreate($value, $type, $options);
    }

    /**
     * @param string $type
     * @return TypeInterface
     */
    public static function get(string $type): TypeInterface
    {
        return self::getInstance()->doGet($type);
    }

    /**
     * @param $value
     * @param string $type
     * @param array $options
     * @return mixed
     */
    private function doCreate($value, string $type, array $options = [])
    {
        $value = $this->convertValue($value, $type);

        if (self::isPhpType($type)) {
            self::checkPhpType($value, $type);
            return $value;
        }

        $typeObject = $this->doGet($type);

        if ($value instanceof $typeObject) {
            return $value;
        }

        return $typeObject->create($value, $options);
    }

    /**
     * @param string $type
     * @return TypeInterface
     */
    private function doGet(string $type): TypeInterface
    {
        if (!($this->subManager instanceof SubManagerInterface)) {
            throw new TypeNotCreatedException(\sprintf("'%s' was not initialized with a SubManager", Type::class));
        }

        if (!$this->subManager->has($type)) {
            throw new TypeNotFoundException(\sprintf("Can't find type '%s'", $type));
        }

        /** @var TypeInterface $typeObject */
        return $this->subManager->get($type);
    }

    public static function checkPhpType($value, string $type)
    {
        $check = true;
        switch ($type) {
            case TypeInterface::TYPE_STRING:
                $check = \is_string($value) || \ctype_digit($value) || \is_numeric($value);
                break;
            case TypeInterface::TYPE_ARRAY:
                $check = \is_array($value);
                break;
            case TypeInterface::TYPE_BOOL:
                $check = \is_bool($value);
                break;
            case TypeInterface::TYPE_CALLABLE:
                $check = \is_callable($value);
                break;
            case TypeInterface::TYPE_FLOAT:
                $check = \is_float($value) || \is_numeric($value);
                break;
            case TypeInterface::TYPE_INT:
                $check = \is_int($value) || \preg_match('/^-?\d+$/', $value);
                break;
        }

        if ($check === false) {
            throw new InvalidTypeException(\sprintf("'%s' is not a '%s'", \gettype($value), $type));
        }
    }

    /**
     * @param $type
     * @return bool
     */
    public static function isPhpType($type): bool
    {
        switch ($type) {
            case TypeInterface::TYPE_STRING:
            case TypeInterface::TYPE_ARRAY:
            case TypeInterface::TYPE_BOOL:
            case TypeInterface::TYPE_CALLABLE:
            case TypeInterface::TYPE_FLOAT:
            case TypeInterface::TYPE_INT:
                return true;
            default:
                return false;
        }
    }

    /**
     * @param $value
     * @param string $type
     * @return mixed
     */
    private function convertValue($value, string $type)
    {
        if ($value instanceof $type) {
            return $value;
        }

        if (!self::isPhpType($type)) {
            return $value;
        }

        switch ($type) {
            case TypeInterface::TYPE_STRING:
            case TypeInterface::TYPE_BOOL:
            case TypeInterface::TYPE_FLOAT:
            case TypeInterface::TYPE_INT:
                $value = \call_user_func(Convert::class . '::convert' . \ucfirst($type), $value);
                break;
            case TypeInterface::TYPE_ARRAY:
            case TypeInterface::TYPE_CALLABLE:
            default:
                break;
        }

        return $value;
    }
}

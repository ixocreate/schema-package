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
use Ixocreate\Schema\Element\PriceElement;

final class PriceType extends AbstractType implements DatabaseTypeInterface, ElementProviderInterface
{
    /**
     * @param $value
     * @return mixed
     */
    protected function transform($value)
    {
        $default = [
            'currency' => null,
            'price' => null,
        ];
        if (!\is_array($value)) {
            return $default;
        }

        if (!\array_key_exists('currency', $value) || !\array_key_exists('price', $value)) {
            return $default;
        }

        $default['currency'] = (string)$value['currency'];
        $default['price'] = (float)$value['price'];

        return $default;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (empty($this->value())) {
            return '';
        }
        return (string)$this->value()['price'];
    }

    public function jsonSerialize()
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public function convertToDatabaseValue()
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public static function baseDatabaseType(): string
    {
        return JsonType::class;
    }

    public static function serviceName(): string
    {
        return 'price';
    }

    public function provideElement(BuilderInterface $builder): ElementInterface
    {
        return $builder->get(PriceElement::class);
    }
}

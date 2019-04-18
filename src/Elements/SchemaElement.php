<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Elements;

use Ixocreate\Schema\StructuralGroupingInterface;
use Ixocreate\Type\Entity\SchemaType;

final class SchemaElement extends AbstractGroup implements StructuralGroupingInterface
{
    /**
     * @return string
     */
    public function inputType(): string
    {
        return SchemaType::class;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return 'schema';
    }

    /**
     * @return string
     */
    public static function serviceName(): string
    {
        return 'schema';
    }
}

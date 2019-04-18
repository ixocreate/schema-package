<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Schema\Elements;

use Ixocreate\Package\Type\Entity\SchemaType;
use Ixocreate\Package\Schema\StructuralGroupingInterface;

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

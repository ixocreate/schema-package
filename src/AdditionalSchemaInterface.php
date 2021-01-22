<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Application\ServiceManager\NamedServiceInterface;
use Ixocreate\Schema\Builder\BuilderInterface;

interface AdditionalSchemaInterface extends NamedServiceInterface
{
    /**
     * @param BuilderInterface $builder
     * @return SchemaInterface
     */
    public function additionalSchema(BuilderInterface $builder): SchemaInterface;
}

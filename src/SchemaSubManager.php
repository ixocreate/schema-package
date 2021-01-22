<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema;

use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\ServiceManager\SubManager\AbstractSubManager;

class SchemaSubManager extends AbstractSubManager implements SchemaProviderInterface
{
    public function provideSchema($name, BuilderInterface $builder, $options = []): SchemaInterface
    {
        /** @var AdditionalSchemaInterface $additionalSchema */
        $additionalSchema = $this->get($name);

        return $additionalSchema->additionalSchema($builder);
    }
}

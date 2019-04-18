<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\AdditionalSchema;

use Ixocreate\Schema\AdditionalSchemaInterface;
use Ixocreate\Schema\BuilderInterface;
use Ixocreate\Schema\SchemaInterface;
use Ixocreate\Schema\SchemaProviderInterface;
use Ixocreate\ServiceManager\SubManager\SubManager;

class AdditionalSchemaSubManager extends SubManager implements SchemaProviderInterface
{
    public function provideSchema($name, BuilderInterface $builder, $options = []): SchemaInterface
    {
        /** @var AdditionalSchemaInterface $additionalSchema */
        $additionalSchema = $this->get($name);

        return $additionalSchema->additionalSchema($builder);
    }
}

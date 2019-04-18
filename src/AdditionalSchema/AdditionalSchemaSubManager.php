<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package\AdditionalSchema;

use Ixocreate\Schema\Package\AdditionalSchemaInterface;
use Ixocreate\Schema\Package\BuilderInterface;
use Ixocreate\Schema\Package\SchemaInterface;
use Ixocreate\Schema\Package\SchemaProviderInterface;
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

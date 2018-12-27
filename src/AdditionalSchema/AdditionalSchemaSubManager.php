<?php
declare(strict_types=1);

namespace Ixocreate\Schema\AdditionalSchema;

use Ixocreate\Contract\Schema\AdditionalSchemaInterface;
use Ixocreate\Contract\Schema\SchemaInterface;
use Ixocreate\Contract\Schema\SchemaReceiverInterface;
use Ixocreate\Schema\Builder;
use Ixocreate\ServiceManager\SubManager\SubManager;

class AdditionalSchemaSubManager extends SubManager implements SchemaReceiverInterface
{

    public function receiveSchema(Builder $builder, array $options = []): SchemaInterface
    {
        /** @var AdditionalSchemaInterface $additionalSchema */
        $additionalSchema = $this->get($options['additionalSchema']);

        return $additionalSchema->receiveSchema($builder);
    }
}
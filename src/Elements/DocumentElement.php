<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Schema\Package\Elements;

use Ixocreate\Media\Package\Type\DocumentType;

final class DocumentElement extends AbstractSingleElement
{
    public function type(): string
    {
        return DocumentType::class;
    }

    public function inputType(): string
    {
        return 'document';
    }

    public static function serviceName(): string
    {
        return 'document';
    }
}

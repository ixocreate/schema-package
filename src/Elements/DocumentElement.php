<?php
declare(strict_types=1);

namespace KiwiSuite\Schema\Elements;

use KiwiSuite\Media\Type\DocumentType;

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
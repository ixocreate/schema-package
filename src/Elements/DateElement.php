<?php
namespace KiwiSuite\Schema\Elements;

use KiwiSuite\CommonTypes\Entity\DateType;

final class DateElement extends AbstractSingleElement
{

    public function inputType(): string
    {
        return 'date';
    }

    public function type(): string
    {
        return DateType::class;
    }

    public static function serviceName(): string
    {
        return 'date';
    }
}

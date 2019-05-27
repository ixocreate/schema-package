<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Misc\Schema\Type;

use Ixocreate\Schema\Type\AbstractType;

final class MockType extends AbstractType
{
    public static function serviceName(): string
    {
        return 'mock';
    }
}

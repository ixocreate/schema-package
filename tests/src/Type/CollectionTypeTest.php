<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Schema\Type;

use Doctrine\DBAL\Types\JsonType;
use Ixocreate\Schema\Type\CollectionType;
use PHPUnit\Framework\TestCase;

class CollectionTypeTest extends TestCase
{
    public function testBaseDatabaseType()
    {
        $this->assertEquals(JsonType::class, CollectionType::baseDatabaseType());
    }

    public function testServiceName()
    {
        $this->assertEquals('collection', CollectionType::serviceName());
    }
}

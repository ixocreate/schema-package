<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Schema\Builder;

use Ixocreate\Misc\Schema\FakeEntity;
use Ixocreate\Schema\Builder\Builder;
use Ixocreate\Schema\Element\ElementSubManager;
use Ixocreate\Schema\Element\TextElement;
use Ixocreate\Schema\Schema;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function testFromEntity()
    {
        $elementSubManager = $this->createMock(ElementSubManager::class);
        $elementSubManager->method('get')->willReturnCallback(function () {
            return new TextElement();
        });

        $builder = new Builder($elementSubManager);

        $schema = $builder->fromEntity(FakeEntity::class);
        $this->assertInstanceOf(Schema::class, $schema);
        $this->assertTrue($schema->has('test'));
    }
}

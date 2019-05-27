<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Schema\Type;

use Doctrine\DBAL\Types\JsonType;
use Ixocreate\Misc\Schema\TypeMockHelper;
use Ixocreate\Schema\Builder\BuilderInterface;
use Ixocreate\Schema\Element\LinkElement;
use Ixocreate\Schema\Link\ExternalLink;
use Ixocreate\Schema\Link\LinkManager;
use Ixocreate\Schema\Type\DateTimeType;
use Ixocreate\Schema\Type\LinkType;
use Ixocreate\Schema\Type\UuidType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ixocreate\Schema\Type\LinkType
 */
final class LinkTypeTest extends TestCase
{
    /**
     * @var LinkType
     */
    private $linkType;

    public function setUp()
    {
        $linkManager = $this->createMock(LinkManager::class);
        $linkManager->method('has')->willReturnCallback(function ($requestedName) {
            if (\in_array($requestedName, [ExternalLink::class, ExternalLink::serviceName()])) {
                return true;
            }

            return false;
        });
        $linkManager->method('get')->willReturnCallback(function ($requestedName) {
            if (\in_array($requestedName, [ExternalLink::class, ExternalLink::serviceName()])) {
                return new ExternalLink();
            }
        });

        $this->linkType = new LinkType($linkManager);


        (new TypeMockHelper($this, [
            LinkType::class => $this->linkType,
            LinkType::serviceName() => $this->linkType,
            UuidType::class => new UuidType(),
            UuidType::serviceName() => new UuidType(),
            DateTimeType::class => new DateTimeType(),
            DateTimeType::serviceName() => new DateTimeType(),
        ], false))->create();
    }

    /**
     * @covers \Ixocreate\Schema\Type\LinkType::baseDatabaseType
     */
    public function testBaseDatabaseType()
    {
        $linkType = $this->linkType;
        $this->assertSame(JsonType::class, $linkType::baseDatabaseType());
    }

    /**
     * @covers \Ixocreate\Schema\Type\LinkType::serviceName
     */
    public function testServiceName()
    {
        $linkType = $this->linkType;
        $this->assertSame("link", $linkType::serviceName());
    }

    /**
     * @covers \Ixocreate\Schema\Type\LinkType::transform
     */
    public function testCreateNoArray()
    {
        $linkType = $this->linkType->create("string");
        $this->assertSame([], $linkType->value());
    }

    /**
     * @covers \Ixocreate\Schema\Type\LinkType::transform
     */
    public function testCreateNoType()
    {
        $linkType = $this->linkType->create(['foo' => 'bar']);
        $this->assertSame([], $linkType->value());
    }

    /**
     * @covers \Ixocreate\Schema\Type\LinkType::transform
     */
    public function testCreateDefaultTarget()
    {
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create(['type' => 'external', 'value' => 'https://www.ixocreate.com']);
        $this->assertSame('_self', $linkType->target());
    }

    /**
     * @covers \Ixocreate\Schema\Type\LinkType::transform
     */
    public function testCreateTarget()
    {
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create(['type' => 'external', 'value' => 'https://www.ixocreate.com', 'target' => '_self']);
        $this->assertSame('_self', $linkType->target());

        /** @var LinkType $linkType */
        $linkType = $this->linkType->create(['type' => 'external', 'value' => 'https://www.ixocreate.com', 'target' => '_blank']);
        $this->assertSame('_blank', $linkType->target());
    }

    /**
     * @covers \Ixocreate\Schema\Type\LinkType::getTarget
     * @covers \Ixocreate\Schema\Type\LinkType::target
     */
    public function testTarget()
    {
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create(['type' => 'external', 'value' => 'https://www.ixocreate.com', 'target' => '_blank']);
        $this->assertSame('_blank', $linkType->target());
        $this->assertSame('_blank', $linkType->getTarget());

        /** @var LinkType $linkType */
        $linkType = $this->linkType->create([]);
        $this->assertSame('_self', $linkType->target());
        $this->assertSame('_self', $linkType->getTarget());
    }

    /**
     * @covers \Ixocreate\Schema\Type\LinkType::getType
     * @covers \Ixocreate\Schema\Type\LinkType::type
     */
    public function testType()
    {
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create(['type' => 'external', 'value' => 'https://www.ixocreate.com', 'target' => '_blank']);
        $this->assertSame('external', $linkType->type());
        $this->assertSame('external', $linkType->getType());

        /** @var LinkType $linkType */
        $linkType = $this->linkType->create([]);
        $this->assertNull($linkType->type());
        $this->assertNull($linkType->getType());
    }

    public function testInvalidType()
    {
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create(['type' => 'invalid', 'value' => 'https://www.ixocreate.com', 'target' => '_blank']);
        $this->assertSame('invalid', $linkType->type());
        $this->assertSame('_blank', $linkType->target());
        $this->assertSame('', (string) $linkType);

        $json = $linkType->jsonSerialize();
        $this->assertNull($json['link']);
    }

    /**
     * @covers \Ixocreate\Schema\Type\LinkType::__toString
     */
    public function testToString()
    {
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create(['type' => 'external', 'value' => 'https://www.ixocreate.com', 'target' => '_self']);
        $this->assertSame('https://www.ixocreate.com', (string) $linkType);

        $linkType = $this->linkType->create([]);
        $this->assertSame('', (string) $linkType);
    }

    /**
     * @covers \Ixocreate\Schema\Type\LinkType::convertToDatabaseValue
     */
    public function testConvertToDatabaseValue()
    {
        $definition = ['type' => 'external', 'target' => '_self', 'value' => 'https://www.ixocreate.com'];
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create($definition);

        $this->assertSame($definition, $linkType->convertToDatabaseValue());

        $definition = [];
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create($definition);

        $this->assertNull($linkType->convertToDatabaseValue());
    }

    public function testJsonSerialize()
    {
        $definition = ['type' => 'external', 'target' => '_self', 'value' => 'https://www.ixocreate.com'];
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create($definition);

        $array = $linkType->jsonSerialize();

        $this->assertArrayHasKey('type', $array);
        $this->assertSame($definition['type'], $array['type']);
        $this->assertArrayHasKey('target', $array);
        $this->assertSame($definition['target'], $array['target']);

        $linkType = $this->linkType->create([]);
        $this->assertSame(['value' => null, 'link' => null], $linkType->jsonSerialize());
    }

    public function testProvideElement()
    {
        $builder = $this->createMock(BuilderInterface::class);
        $builder->method('get')->willReturn(new LinkElement());

        $this->assertInstanceOf(LinkElement::class, $this->linkType->provideElement($builder));
    }

    public function testSerialize()
    {
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create(['type' => 'external', 'value' => 'https://www.ixocreate.com', 'target' => '_blank']);
        $linkType = \unserialize(\serialize($linkType));

        $this->assertSame('external', $linkType->type());
        $this->assertSame('_blank', $linkType->target());
        $this->assertSame('https://www.ixocreate.com', (string) $linkType);
    }
}

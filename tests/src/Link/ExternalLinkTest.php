<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Schema\Link;

use Ixocreate\Schema\Link\ExternalLink;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ixocreate\Schema\Link\ExternalLink
 */
class ExternalLinkTest extends TestCase
{
    public function testServiceName()
    {
        $this->assertSame('external', ExternalLink::serviceName());
    }

    public function testLabel()
    {
        $this->assertSame('External', (new ExternalLink())->label());
    }

    public function testCreate()
    {
        $externalLink = new ExternalLink();

        $newExternalLink = $externalLink->create('https://www.ixocreate.com');
        $this->assertNotSame($newExternalLink, $externalLink);
        $this->assertSame('https://www.ixocreate.com', $newExternalLink->toJson());

        $clonedExternalLink = $externalLink->create($newExternalLink);
        $this->assertNotSame($clonedExternalLink, $newExternalLink);
        $this->assertSame('https://www.ixocreate.com', $clonedExternalLink->toJson());

        $newExternalLink = $externalLink->create([]);
        $this->assertNotSame($newExternalLink, $externalLink);
        $this->assertNull($newExternalLink->toJson());
    }

    public function testToJson()
    {
        $externalLink = new ExternalLink();

        $newExternalLink = $externalLink->create('https://www.ixocreate.com');
        $this->assertSame('https://www.ixocreate.com', $newExternalLink->toJson());

        $newExternalLink = $externalLink->create([]);
        $this->assertNull($newExternalLink->toJson());
    }

    public function testToDatabase()
    {
        $externalLink = new ExternalLink();

        $newExternalLink = $externalLink->create('https://www.ixocreate.com');
        $this->assertSame('https://www.ixocreate.com', $newExternalLink->toDatabase());

        $newExternalLink = $externalLink->create([]);
        $this->assertNull($newExternalLink->toDatabase());
    }

    public function testAssemble()
    {
        $externalLink = new ExternalLink();

        $newExternalLink = $externalLink->create('https://www.ixocreate.com');
        $this->assertSame('https://www.ixocreate.com', $newExternalLink->assemble());

        $newExternalLink = $externalLink->create([]);
        $this->assertSame('', $newExternalLink->assemble());
    }

    public function testSerialize()
    {
        $externalLink = new ExternalLink();
        $externalLink = $externalLink->create('https://www.ixocreate.com');
        $externalLink = \unserialize(\serialize($externalLink));
        $this->assertSame('https://www.ixocreate.com', $externalLink->toDatabase());
    }
}

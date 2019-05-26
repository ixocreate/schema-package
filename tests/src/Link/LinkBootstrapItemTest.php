<?php
declare(strict_types=1);

namespace Ixocreate\Test\Schema\Link;

use Ixocreate\Schema\Link\LinkBootstrapItem;
use Ixocreate\Schema\Link\LinkConfigurator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ixocreate\Schema\Link\LinkBootstrapItem
 */
class LinkBootstrapItemTest extends TestCase
{
    public function testBootstrapItem()
    {
        $bootstrapItem = new LinkBootstrapItem();
        $this->assertInstanceOf(LinkConfigurator::class, $bootstrapItem->getConfigurator());
        $this->assertSame('link', $bootstrapItem->getVariableName());
        $this->assertSame('link.php', $bootstrapItem->getFileName());
    }
}

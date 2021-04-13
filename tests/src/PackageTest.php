<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Schema;

use Ixocreate\Schema\Element\ElementBootstrapItem;
use Ixocreate\Schema\Link\LinkBootstrapItem;
use Ixocreate\Schema\Package;
use Ixocreate\Schema\Type\TypeBootstrapItem;
use Ixocreate\Schema\Type\TypeSubManager;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /**
     * @covers \Ixocreate\Schema\Package
     */
    public function testPackage()
    {
        $serviceManager = $this->getMockBuilder(ServiceManagerInterface::class)->getMock();
        $serviceManager->method('get')->willReturn($this->createMock(TypeSubManager::class));

        $package = new Package();
        $package->boot($serviceManager);

        $this->assertSame([
            TypeBootstrapItem::class,
            ElementBootstrapItem::class,
            LinkBootstrapItem::class,
        ], $package->getBootstrapItems());

        $this->assertEmpty($package->getDependencies());
        $this->assertDirectoryExists($package->getBootstrapDirectory());
    }
}

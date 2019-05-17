<?php
declare(strict_types=1);

namespace Ixocreate\Test\Schema\Type;

use Doctrine\DBAL\Types\JsonType;
use Doctrine\ORM\EntityManagerInterface;
use Ixocreate\Admin\AdminConfigurator;
use Ixocreate\Admin\Config\AdminConfig;
use Ixocreate\Admin\Config\AdminProjectConfig;
use Ixocreate\Application\Uri\ApplicationUri;
use Ixocreate\Application\Uri\ApplicationUriConfigurator;
use Ixocreate\Asset\Asset;
use Ixocreate\Cms\CmsConfigurator;
use Ixocreate\Cms\Config\Config;
use Ixocreate\Cms\PageType\PageTypeInterface;
use Ixocreate\Cms\PageType\PageTypeSubManager;
use Ixocreate\Cms\Repository\PageRepository;
use Ixocreate\Cms\Repository\SitemapRepository;
use Ixocreate\Cms\Router\CmsRouter;
use Ixocreate\Cms\Router\PageRoute;
use Ixocreate\Media\Handler\HandlerInterface;
use Ixocreate\Media\Handler\MediaHandlerSubManager;
use Ixocreate\Media\Repository\MediaRepository;
use Ixocreate\Media\Uri\MediaUri;
use Ixocreate\Schema\Type\LinkType;
use Ixocreate\ServiceManager\ServiceManagerConfigInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Routing\RouteCollection;
use Zend\Expressive\MiddlewareContainer;
use Zend\Expressive\MiddlewareFactory;

final class LinkTypeTest extends TestCase
{
    /**
     * @var LinkType
     */
    private $linkType;

    public function setUp()
    {
        $pageTypeSubmanager = new PageTypeSubManager(
            $this->createMock(ServiceManagerInterface::class),
            $this->createMock(ServiceManagerConfigInterface::class),
            PageTypeInterface::class
        );
        $sitemapRepository = new SitemapRepository($this->createMock(EntityManagerInterface::class));
        $pageRepository = new PageRepository(
            $this->createMock(EntityManagerInterface::class),
            $pageTypeSubmanager,
            $sitemapRepository
        );
        $mediaRepository = new MediaRepository($this->createMock(EntityManagerInterface::class));

        $pageRoute = new PageRoute(
            new Config(new CmsConfigurator()),
            new CmsRouter(new RouteCollection(), new MiddlewareFactory($this->createMock(MiddlewareContainer::class))),
            new ApplicationUri(new ApplicationUriConfigurator())
        );

        $mediaUri = new MediaUri(
            new Packages(),
            new AdminConfig(
                new AdminProjectConfig(new AdminConfigurator()),
                $this->createMock(UriInterface::class),
                new Asset(new Packages())
            ),
            new MediaHandlerSubManager(
                $this->createMock(ServiceManagerInterface::class),
                $this->createMock(ServiceManagerConfigInterface::class),
                HandlerInterface::class
            )
        );

        $this->linkType = new LinkType(
            $pageRepository,
            $mediaRepository,
            $pageRoute,
            $mediaUri
        );
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
     * @covers \Ixocreate\Schema\Type\LinkType::__toString
     */
    public function testToString()
    {
        /** @var LinkType $linkType */
        $linkType = $this->linkType->create(['type' => 'external', 'value' => 'https://www.ixocreate.com', 'target' => '_self']);
        $this->assertSame('https://www.ixocreate.com', (string) $linkType);
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
    }
}

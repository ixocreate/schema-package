<?php
declare(strict_types=1);

namespace Ixocreate\Schema\Link;

use Ixocreate\Application\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\Configurator\ConfiguratorInterface;

final class LinkBootstrapItem implements BootstrapItemInterface
{

    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new LinkConfigurator();
    }

    /**
     * @return string
     */
    public function getVariableName(): string
    {
        return 'link';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return 'link.php';
    }
}

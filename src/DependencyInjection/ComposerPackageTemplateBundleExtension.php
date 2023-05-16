<?php

namespace Mubiridziri\ComposerPackageTemplate\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ComposerPackageTemplateBundleExtension extends Extension
{


    public function load(array $configs, ContainerBuilder $container)
    {
        $configDir = new FileLocator(__DIR__ . '/../Resources/config');

        $loader = new YamlFileLoader($container, $configDir);
        $loader->load('services.yaml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
    }
}

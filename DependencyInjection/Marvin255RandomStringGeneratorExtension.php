<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Object tha defines all bundle data.
 */
class Marvin255RandomStringGeneratorExtension extends Extension
{
    /**
     * {@inheritDoc}
     *
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->loadConfigurationToContainer($configs, $container);
        $this->loadServicesToContainer($container);
    }

    /**
     * Registers bundle configurations.
     *
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    protected function loadConfigurationToContainer(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        foreach ($config as $key => $value) {
            $container->setParameter(Configuration::CONFIG_NAME . '.' . $key, $value);
        }
    }

    /**
     * Register bundle services.
     *
     * @param ContainerBuilder $container
     *
     * @throws Exception
     */
    protected function loadServicesToContainer(ContainerBuilder $container): void
    {
        $configDir = dirname(__DIR__) . '/Resources/config';
        $loader = new YamlFileLoader($container, new FileLocator($configDir));
        $loader->load('services.yaml');
    }
}

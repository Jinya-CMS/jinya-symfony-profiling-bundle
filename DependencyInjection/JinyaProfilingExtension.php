<?php
/**
 * Created by PhpStorm.
 * User: imanuel
 * Date: 03.11.18
 * Time: 02:43
 */

namespace JinyaProfiling\Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class JinyaProfilingExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('jinya_profiling.profiler.event_subscriber');
        $definition->setArgument('profilerOutDir', $config['profiler']['out_dir']);
        $definition->setArgument('profilerEnabled', $config['profiler']['enabled']);
    }
}
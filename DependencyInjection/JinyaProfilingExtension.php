<?php
/**
 * Created by PhpStorm.
 * User: imanuel
 * Date: 03.11.18
 * Time: 02:43
 */

namespace JinyaProfiling\Bundle\DependencyInjection;

use JinyaProfiling\Bundle\EventSubscriber\JinyaProfilerEventSubscriber;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class JinyaProfilingExtension extends ConfigurableExtension
{

    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    protected function loadInternal(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config'));
        $loader->load('services.yml');

        $definition = $container->getDefinition(JinyaProfilerEventSubscriber::class);
        $definition->replaceArgument('$profilerOutDir', $configs['out_dir']);
        $definition->replaceArgument('$profilerEnabled', $configs['enabled']);
    }
}
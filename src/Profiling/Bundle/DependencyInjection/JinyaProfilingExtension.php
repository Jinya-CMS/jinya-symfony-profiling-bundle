<?php
/**
 * Created by PhpStorm.
 * User: imanuel
 * Date: 03.11.18
 * Time: 02:43
 */

namespace Jinya\Profiling\Bundle\DependencyInjection;

use Jinya\Profiling\Bundle\EventSubscriber\Profiling\JinyaProfilerEventSubscriber;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class JinyaProfilingExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition(JinyaProfilerEventSubscriber::class);
        $definition->setArgument('profilerOutDir', $config['profiler']['out_dir']);
        $definition->setArgument('profilerEnabled', $config['profiler']['enabled']);
    }
}
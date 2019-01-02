<?php
/**
 * Created by PhpStorm.
 * User: imanuel
 * Date: 12.11.18
 * Time: 21:29
 */

namespace JinyaProfiling\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root = $treeBuilder->root('jinya');

        // @formatter:off
        $root->children()
            ->arrayNode('profiler')
                ->children()
                    ->scalarNode('out_dir')
                        ->defaultValue('%kernel.project_dir%/var/profiler')
                        ->info('Folder where the profiler output is stored')
                    ->end()
                    ->booleanNode('enabled')
                        ->defaultValue(getenv('APP_DEBUG' === 'yes'))
                        ->info('Enables the profiling')
                    ->end()
                ->end()
            ->end()
        ->end();
        // @formatter:on

        return $treeBuilder;
    }
}
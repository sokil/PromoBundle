<?php

namespace Sokil\PromoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('promo');

        $rootNode
            ->children()
                ->arrayNode('away')
                    ->canBeUnset()
                    ->children()
                        ->booleanNode('allowed')->defaultValue(false)->end()
                        ->arrayNode('domainWhiteList')
                            ->prototype('scalar')->end()
                        ->end()
                        ->booleanNode('track')->end()
                    ->end()
                ->end()
                ->arrayNode('tracking')
                    ->children()
                        ->scalarNode('engine')->defaultValue('blackhole')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}

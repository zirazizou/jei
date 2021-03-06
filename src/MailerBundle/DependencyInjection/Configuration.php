<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/23/2018
 * Time: 4:21 PM
 */

namespace MailerBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('Mailer');
        $rootNode
            ->children()
                ->arrayNode('client')
                    ->children()
                        ->scalarNode('object')->end()
                        ->scalarNode('body')->end()
                        ->scalarNode('event_date')->end()
                    ->end()
                ->end()
                ->arrayNode('fournisseur')
                    ->children()
                        ->scalarNode('object')->end()
                        ->scalarNode('body')->end()
                     ->end()
            ->end()
        ->end();
        return $treeBuilder;

    }
}
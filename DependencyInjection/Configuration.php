<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Object for bundle configurations.
 *
 * @internal
 *
 * @psalm-api
 */
final class Configuration implements ConfigurationInterface
{
    public const CONFIG_NAME = 'marvin255_random_string_generator';

    /**
     * {@inheritdoc}
     *
     * @psalm-suppress UndefinedMethod
     * @psalm-suppress MixedMethodCall
     */
    #[\Override]
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::CONFIG_NAME);
        $treeBuilder->getRootNode()
            ->children()
                ->booleanNode('dummy')
                    ->defaultValue(false)
                ->end()
                ->scalarNode('dummy_string')
                    ->defaultValue('')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

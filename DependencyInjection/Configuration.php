<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Object for bundle configurations.
 */
class Configuration implements ConfigurationInterface
{
    public const CONFIG_NAME = 'marvin255_random_string_generator';

    /**
     * {@inheritdoc}
     *
     * @psalm-suppress UndefinedMethod
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::CONFIG_NAME);
        $treeBuilder->getRootNode()
            ->end()
        ;

        return $treeBuilder;
    }
}

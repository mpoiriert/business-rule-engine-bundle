<?php

namespace Nucleus\Bundle\BusinessRuleEngineBundle\DependencyInjection;

use \Symfony\Component\HttpKernel\DependencyInjection\Extension;
use \Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use \Symfony\Component\DependencyInjection\ContainerBuilder;
use \Symfony\Component\Config\FileLocator;

class NucleusBusinessRuleEngineExtension extends Extension
{
    /**
     * Handles the knp_menu configuration.
     *
     * @param array            $configs   The configurations being loaded
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $fileLocator = new FileLocator(__DIR__.'/../Resources/config');
        $loader = new XmlFileLoader($container, $fileLocator);
        $loader->load('business_rule_engine.xml');
    }

    public function getAlias()
    {
        return 'nucleus_business_rule_engine';
    }
}
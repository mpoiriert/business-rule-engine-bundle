<?php

namespace Nucleus\Bundle\BusinessRuleEngineBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use InvalidArgumentException;

class BusinessRuleCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(
            'nucleus.business_rule_engine.rule_provider'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'nucleus.business_rule_engine.rule'
        );

        foreach ($taggedServices as $id => $rules) {
            foreach ($rules as $attributes) {
                if (!isset($attributes['ruleName'])) {
                    throw new InvalidArgumentException(
                        'Service [' . $id . '] must define the [ruleName] attribute on [nucleus.business_rule_engine.rule] tags.'
                    );
                }
                $definition->addMethodCall(
                    'setServiceRuleCorrespondence',
                    array($attributes['ruleName'],$id)
                );
            }
        }
    }

}
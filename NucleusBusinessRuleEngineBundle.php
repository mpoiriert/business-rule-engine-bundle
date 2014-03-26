<?php

namespace Nucleus\Bundle\BusinessRuleEngineBundle;

use Nucleus\Bundle\BusinessRuleEngineBundle\DependencyInjection\BusinessRuleCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NucleusBusinessRuleEngineBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new BusinessRuleCompilerPass());
    }
}
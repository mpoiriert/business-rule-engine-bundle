<?php

namespace Nucleus\Bundle\BusinessRuleEngineBundle\Tests\DependencyInjection;


class RuleService
{
    public function __invoke()
    {
        return true;
    }
}
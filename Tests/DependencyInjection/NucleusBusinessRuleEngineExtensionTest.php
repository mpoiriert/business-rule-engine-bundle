<?php

namespace Nucleus\Bundle\BusinessRuleEngineBundle\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NucleusBusinessRuleEngineExtensionTest extends WebTestCase
{
    public function test()
    {
        $client = static::createClient();
        $engine = $client->getContainer()->get('nucleus.business_rule_engine');
        /* @var $engine \Nucleus\BusinessRuleEngine\IBusinessRuleEngine */
        $this->assertTrue($engine->check('testRuleTrue'));
    }
}
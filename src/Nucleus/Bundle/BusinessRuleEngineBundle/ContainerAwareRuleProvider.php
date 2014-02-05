<?php

namespace Nucleus\Bundle\BusinessRuleEngineBundle;

use Nucleus\BusinessRuleEngine\InMemoryRuleProvider;
use Nucleus\BusinessRuleEngine\IRuleProvider;
use Nucleus\BusinessRuleEngine\RuleNotFoundException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerAwareRuleProvider extends InMemoryRuleProvider implements IRuleProvider
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * A associative array that map a rule name with the corresponding service
     *
     * @var array
     */
    private $ruleServiceMapping;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function setServiceRuleCorrespondence($ruleName, $serviceName)
    {
        $this->ruleServiceMapping[$ruleName] = $serviceName;
    }

    /**
     * Return a rule base on it's name
     *
     * @param $ruleName
     *
     * @throws RuleNotFoundException
     *
     * @return callable
     */
    public function getRule($ruleName)
    {
        if(parent::hasRule($ruleName)) {
            return parent::getRule($ruleName);
        }

        if(!$this->hasRule($ruleName)) {
            throw new RuleNotFoundException(RuleNotFoundException::formatMessage($ruleName));
        }

        return $this->container->get($this->ruleServiceMapping[$ruleName]);
    }

    /**
     * Return if a rule is available or not
     *
     * @param $ruleName
     *
     * @return boolean
     */
    public function hasRule($ruleName)
    {
        if(parent::hasRule($ruleName)) {
            return true;
        }

        if(!array_key_exists($ruleName,$this->ruleServiceMapping)) {
            return false;
        }

        return $this->container->has($this->ruleServiceMapping[$ruleName]);
    }
}
Business Rule Engine Bundle
===========================

[![Build Status](https://api.travis-ci.org/mpoiriert/business-rule-engine-bundle.png?branch=master)](http://travis-ci.org/mpoiriert/business-rule-engine-bundle)

Integration of the business-rule-engine as a Symfony bundle

Integration of the [BusinessRuleEngine](https://github.com/mpoiriert/business-rule-engine) as a Symfony bundle.

You should read the Business Rule Engine documentation to know how and why to use it. The current documentation
is meant to explain and to enable it and configure it in symfony.

```PHP

<?php

// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new Nucleus\Bundle\BusinessRuleEngineBundle\NucleusBusinessRuleEngineBundle(),
    // ...
);

```

From there you can use the BusinessRuleEngine.

The service is named __nucleus.business_rule_engine__ so you can access it via the service container like this:

```PHP

<?php

$businessRuleEngine = $serviceContainer->get('nucleus.business_rule_engine');

```

Or injecting it in your service. Be sure to use the interface __Nucleus\BusinessRuleEngine\IBusinessRuleEngine__ when
you are referencing the object.

### Adding a service as a rule ###

To add a service as a rule you need to tag the specific service.

```XML

<service id="my_namespace.my_module.my_service" class="MyNamespace\MyModule\MyServiceClass">
    <tag name="nucleus.business_rule_engine.rule" ruleName="myRuleName" />
</service>

```

*The example is in xml, refer to symfony doc to know how to tag in YML or PHP.*

The tag named __nucleus.business_rule_engine.rule__ is use by this bundle to know witch service are a rule.
The attribute __ruleName__ will be the one you must refer when calling the business rule engine.

Since the BusinessRuleEngine is expecting a callable to be a rule, be sure to implement the __invoke magic method in
php on your service.

```PHP

<?php

namespace MyNamespace\MyModule;

class MyServiceClass
{
    /* ... */

    public function __invoke($toto)
    {
        /* ... do processing ... */

        return $result;//The business rule engine expect to receive a boolean value in return
    }
}

```

*In the bundle we are implementing a IRuleProvider that is ContainerAware so service will not be loaded until you call
a rule.*
>>>>>>> documentation for the integration in symfony

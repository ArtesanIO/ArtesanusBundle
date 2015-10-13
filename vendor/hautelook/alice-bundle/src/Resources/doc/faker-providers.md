# Faker Providers

## Simple Provider

As explained in [nelmio/alice](https://github.com/nelmio/alice#custom-faker-data-providers) documentation, you have
three ways to declare custom data provider. To use [Custom Faker Provider classes][1]
you will have to declare them as services:

```php
<?php

namespace AppBundle\DataFixtures\Faker\Provider;

class FooProvider
{
    public static function foo($str)
    {
        return 'foo'.$str;
    }
}
```

Then declare it as a service with the `hautelook_alice.faker.provider` tag:

```yaml
# app/config/services.yml

services:
    faker.provider.foo:
        class: AppBundle\DataFixtures\Faker\Provider\FooProvider
        tags: [ { name: hautelook_alice.faker.provider } ]
```

That's it! You can now use it in your fixtures:

```yaml
# src/AppBundle/DataFixtures/ORM/dummy.yml

AppBundle\Entity\Dummy:
    brand{1..10}:
        name: <foo('a string')>
```

**Warning**: rely on [Custom Faker Providers helpers][2] to generate random data (most of them are static).

## Advanced Provider

Sometimes, your Provider needs to extend the [Faker Base Provider][2]
or one of it's children. The issue is it needs a [`Faker\Generator`](https://github.com/fzaninotto/Faker/blob/master/src/Faker/Generator.php)
instance. In such cases, this bundle provides you a configured generator `hautelook_alice.faker` to help the
declaration of your provider. This faker generator instance is configured with:
* the bundle locale
* the bundle seed
* the registered providers

Example:
```php
<?php

namespace AppBundle\DataFixtures\Faker\Provider;

use Faker\Provider\Base as BaseProvider;

class FooProvider extends BaseProvider;
{
    public static function foo($str)
    {
        return 'foo'.$str;
    }
}
```

```yaml
# app/config/services.yml

services:
    faker.provider.foo:
        class: AppBundle\DataFixtures\Faker\Provider\FooProvider
        arguments: [ @hautelook_alice.faker ]
        tags: [ { name: hautelook_alice.faker.provider } ]
```

Previous chapter: [Advanced usage](advanced-usage.md)<br />
Next chapter: [Custom Alice Processors](alice-processors.md)

[1]: https://github.com/nelmio/alice/blob/master/doc/customizing-data-generation.md#add-a-custom-faker-provider-class
[2]: https://github.com/fzaninotto/Faker/blob/master/src/Faker/Provider/Base.php

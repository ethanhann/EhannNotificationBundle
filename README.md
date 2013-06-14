EhannNotificationBundle
=

Twitter Bootstrap-ready notification bundle for Symfony2.

## Related Bundles

<a href="https://github.com/ethanhann/EhannFrontendBundle">EhannFrontendBundle</a>

Installation
==

Add EhannNotificationBundle in your composer.json:

```js
{
    "require": {
        "ehann/notification-bundle": "1.*"
    }
}
```

Download bundle:

``` bash
$ php composer.phar update ehann/notification-bundle
```

Add the EhannNotificationBundle to your AppKernel.php

```php
public function registerBundles()
{
    $bundles = array(
        ...
        new Ehann\NotificationBundle\NotificationBundleBundle(),
        ...
    );
    ...
}
```

Usage Documentation
==
https://github.com/ethanhann/EhannNotificationBundle/blob/master/Resources/doc/usage.md

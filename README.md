Promo Bundle
============

[![Latest Stable Version](https://poser.pugx.org/sokil/promo-bundle/v/stable.png)](https://packagist.org/packages/sokil/deploy-bundle)
[![Total Downloads](http://img.shields.io/packagist/dt/sokil/promo-bundle.svg)](https://packagist.org/packages/sokil/deploy-bundle)

## Installation

Add composer dependency:

```
composer.phar require sokil/promo-bundle
```

Add bundle to your `AppKernel`:

```php
<?php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Sokil\PromoBundle\PromoBundle(),
        );
    }
}
```

Configure routes in `app/config/routing.yml`:

```yaml
# show landing page
landing_index:
  path: /
  defaults:
    _controller: PromoBundle:Landing:index
  methods:  [GET]

# track exit and redirect to external url
landing_away:
  path: /away
  defaults:
    _controller: PromoBundle:Landing:away
  methods:  [GET]
```

## Away action

Away action used to redirect to some url from promo page.

First add configuration to bundle:

```yaml
promo:
  away:
    allowed: true # allow redirect to external urls
    domainWhiteList: # if specified, allow redirect only to specified domains
      - http://example.com
    track: true # allow track of away campainn (default: false)
```

## Tracking

Engine may be `doctrine_orm` or `blackhole`.

```yaml
promo:
  tracking:
    engine: doctrine_orm # engine to store tracking data
```

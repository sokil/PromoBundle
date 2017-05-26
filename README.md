Promo Bundle
============

[![Latest Stable Version](https://poser.pugx.org/sokil/promo-bundle/v/stable.png)](https://packagist.org/packages/sokil/deploy-bundle)
[![Total Downloads](http://img.shields.io/packagist/dt/sokil/promo-bundle.svg)](https://packagist.org/packages/sokil/deploy-bundle)

## Installation

```
composer.phar require sokil/promo-bundle
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

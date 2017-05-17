# Blast DoctrineSessionBundle

[![Build Status](https://travis-ci.org/blast-project/DoctrineSessionBundle.svg?branch=master)](https://travis-ci.org/blast-project/DoctrineSessionBundle)
[![Coverage Status](https://coveralls.io/repos/github/blast-project/DoctrineSessionBundle/badge.svg?branch=master)](https://coveralls.io/github/blast-project/DoctrineSessionBundle?branch=master)
[![License](https://img.shields.io/github/license/blast-project/DoctrineSessionBundle.svg?style=flat-square)](./LICENCE.md)

[![Latest Stable Version](https://poser.pugx.org/blast-project/doctrine-session-bundle/v/stable)](https://packagist.org/packages/blast-project/doctrine-session-bundle)
[![Latest Unstable Version](https://poser.pugx.org/blast-project/doctrine-session-bundle/v/unstable)](https://packagist.org/packages/blast-project/doctrine-session-bundle)
[![Total Downloads](https://poser.pugx.org/blast-project/doctrine-session-bundle/downloads)](https://packagist.org/packages/blast-project/doctrine-session-bundle)



The goal of this bundle is to make the use of Doctrine as session handler for Symfony

Installation
============

Downloading
-----------

  $ composer require blast-project/doctrine-session-bundle


Add to your AppKernel
---------------------

```php
//...

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            //...

            new Blast\DoctrineSessionBundle\BlastDoctrineSessionBundle(),

        ];
        //...
    }
    //...
}
```

Database
--------

  $ php bin/console doctrine:database:create

Or

  $ php bin/console doctrine:schema:update --force

Usage
-----
```php

use Blast\DoctrineSessionBundle\Handler\DoctrineORMHandler;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

//...

        $doctrinehandler = new DoctrineORMHandler(
                         $this->get('doctrine'),
                         'Blast\DoctrineSessionBundle\Entity\Session');

        $storage = new NativeSessionStorage(
                 array(),
                 $doctrinehandler
        );

        $session = new Session($storage);
        $session->start();
//...

```

See
---

http://symfony.com/doc/current/components/http_foundation/session_configuration.html

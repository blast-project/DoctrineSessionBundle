<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blast\Bundle\DoctrineSessionBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\FileLoader;
use Blast\Bundle\CoreBundle\DependencyInjection\BlastCoreExtension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class BlastDoctrineSessionExtension extends BlastCoreExtension
{
    /**
     * {@inheritdoc}
     */
    public function doLoad(ContainerBuilder $container, FileLoader $loader, array $config)
    {
        $container->setParameter('blast_doctrine_session_class', 'Blast\Bundle\DoctrineSessionBundle\Entity\Session');

        return $this;
    }
}

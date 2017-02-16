<?php

namespace Blast\DoctrineSessionBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\FileLoader;
use Blast\CoreBundle\DependencyInjection\BlastCoreExtension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class BlastDoctrineSessionExtension extends BlastCoreExtension
{
    /**
     * {@inheritdoc}
     */
    public function doLoad(ContainerBuilder $container, FileLoader $loader, array $config)
    {
        $container->setParameter('blast_doctrine_session_class', 'Blast\DoctrineSessionBundle\Entity\Session');
        
        return $this;
    }
}

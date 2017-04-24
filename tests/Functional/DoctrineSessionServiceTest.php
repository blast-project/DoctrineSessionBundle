<?php

namespace  Blast\DoctrineSessionBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

/*
 * @todo find a way to launch it or not by configuration
 */

// prepare database if exists
//if (file_exists($file = __DIR__.'/prepare.database.php')) {
//    require_once $file;
//}

class BlastDoctrineSessionServiceTest extends KernelTestCase
{
    
    protected $container;
    
    protected function setUp()
    {
        static::bootKernel();
        
        /** @var Container $container */
        $this->container = self::$kernel->getContainer();
    }
    
    public function testServicesAreInitializable()
    {
        
        $serviceIds = array_filter($this->container->getServiceIds(), function ($serviceId) {
            return 0 === strpos($serviceId, ' blast_doctrine');
        });
        
        foreach ($serviceIds as $serviceId) {
            $this->assertNotNull($this->container->get($serviceId));
        }
    }
}

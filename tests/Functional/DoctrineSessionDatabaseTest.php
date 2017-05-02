<?php

namespace  Blast\DoctrineSessionBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class BlastDoctrineSessionDatabaseTest extends KernelTestCase
{
    protected $container;

    
    protected function setUp()
    {
        static::bootKernel(['environment' => 'test']);
        
        /** @var Container $container */
        $this->container = self::$kernel->getContainer();
        var_dump(self::$kernel->getEnvironment());
        var_dump(self::$kernel->getContainer()->getParameter('database_name'));
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

<?php

namespace Blast\DoctrineSessionBundle\DependencyInjection\Test\Unit;

use Blast\DoctrineSessionBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * @var Configuration
     */
    protected $object;
    protected $testtree;

    protected function setUp()
    {
    
        $this->object = new Configuration();
    }

    protected function tearDown()
    {
    }

    /**
     * @covers Blast\DoctrineSessionBundle\DependencyInjection\Configuration::getConfigTreeBuilder
     */
    public function testGetConfigTreeBuilder()
    {
        $this->testtree = $this->object->getConfigTreeBuilder();
        $this->assertInstanceOf('Symfony\Component\Config\Definition\Builder\TreeBuilder', $this->testtree);
        /**
         * @TODO maybe we need to add a test of root name or some other content
         */
    }
}

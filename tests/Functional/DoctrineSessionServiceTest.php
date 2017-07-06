<?php

namespace  Blast\DoctrineSessionBundle\Tests\Functional;

use Blast\TestsBundle\Functional\BlastTestCase;

class DoctrineSessionServiceTest extends BlastTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }
    
    public function testServicesAreInitializable()
    {
        $this->isServicesAreInitializable('blast_doctrine_session');
    }
}

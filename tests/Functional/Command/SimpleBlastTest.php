<?php
namespace Blast\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;
use Blast\DoctrineSessionBundle\Command\CollectGarbageCommand;

class SimpleBlastTest extends BlastTest
{
    /**
     * @var CollectGarbageCommand
     */
   
   
    protected function setUp()
    {
        $this->cacheClear();
        $this->createDatabase();
        $this->updateSchema();
        $this->validateSchema();
    }
    
    protected function tearDown()
    {
        $this->dropDatabase();
    }

    public function testEmpty()
    {
        /* trigger setup */
    }
}

<?php
namespace Blast\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Blast\TestsBundle\Functional\BlastTestCase;

class CollectGarbageCommandTest extends BlastTestCase
{
    protected function setUp()
    {
        parent::setUp();
        // $this->createDatabase();
        /**
         * @todo: grrr cacheClear need the database...
         */
        $this->cacheClear();
        $this->updateSchema();
        $this->validateSchema();
    }
    
    protected function tearDown()
    {
        // $this->dropDatabase();
    }

    public function testCommand()
    {
        /**
         * @todo: need a simple way to add session and check if it is well garbaged
         *
         */
        $this->launchCommand([
            'command' => 'blast:session:collect-garbage',
            '--all' => true,
        ]);

        /**
         * @todo : should check if there are session in database or not
         */
        $this->launchCommand([
            'command' => 'blast:session:collect-garbage',
            'limit' => '3',
        ]);
    }
}

<?php
namespace Blast\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;
use Blast\DoctrineSessionBundle\Command\CollectGarbageCommand;

class CollectGarbageCommandTest extends BlastTest
{
    /**
     * @var CollectGarbageCommand
     */
    protected $object;
    protected $application;
    protected $input;
    protected $output;
   
    protected function setUp()
    {
        // $this->createDatabase();
        /**
         * @todo: grrr cacheClear need the database...
         */
        $this->cacheClear();
        $this->updateSchema();
        $this->validateSchema();
        // parent::setUp();
        static::bootKernel();

        $this->object = new CollectGarbageCommand();
        $this->application = new Application(self::$kernel);
        $this->application->add($this->object);

        /**
         * @todo: need a simple way to add session and check if it is well garbaged
         */
        $this->markTestSkipped(
            'need a simple way to add session and check session'
        );
    }
    
    protected function tearDown()
    {
        // $this->dropDatabase();
    }

    public function testCommand()
    {
        /**
         * @todo : should add some session before purge test
         * @todo : should find a way to test all availlable option
         */
        $this->input = new ArrayInput(array(
            'command' => 'blast:session:collect-garbage',
            '--all' => true,
        ));
        $this->output = new ConsoleOutput();
        $this->object->run($this->input, $this->output);

        /**
         * @todo : should check if there are session in database or not
         */
        $this->input = new ArrayInput(array(
            'command' => 'blast:session:collect-garbage',
            'limit' => '3',
        ));
        $this->output = new ConsoleOutput();
        $this->object->run($this->input, $this->output);

        //        if (function_exists('xdebug_disable')) {
        //    xdebug_disable();
        //    var_dump($this->output);
        // }
    }
}

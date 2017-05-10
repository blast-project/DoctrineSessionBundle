<?php
namespace Blast\Tests\Functional;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-04-24 at 16:53:17.
 */
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
        $this->cacheClear();
        $this->createDatabase();
        $this->updateSchema();
        $this->validateSchema();
        
        //        parent::setUp();
        static::bootKernel();

        /* Todo Should a Command Tools in Blast Test */
        $this->object = new CollectGarbageCommand();
        $this->application = new Application(self::$kernel);
        $this->application->add($this->object);
    }
    
    protected function tearDown()
    {
        $this->dropDatabase();
    }

    public function testCommand()
    {
        /*
         * @todo : should add some session before purge test
         * @todo should find a way to test all availlable option
         */
        $this->input = new ArrayInput(array(
            'command' => 'blast:session:collect-garbage',
            '--all' => true,
        ));

        $this->output = new ConsoleOutput();
        
        $this->object->run($this->input, $this->output);


        /*
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

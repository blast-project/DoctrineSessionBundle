<?php
namespace Blast\Tests\Functional;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-04-24 at 16:53:17.
 */
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;
use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;

class BlastDatabaseTest extends KernelTestCase
{
    protected $application;
    protected $input;
    protected $output;
    
    
    protected function dropDatabase()
    {
        static::bootKernel();
        $this->application = new Application(self::$kernel);
        $command = new DropDatabaseDoctrineCommand();
        $this->application->add($command);
        $input = new ArrayInput(array(
            'command' => 'doctrine:database:drop',
            '--if-exists' => true,
            '--force' => true,
        ));
        $command->run($input, new ConsoleOutput());
    }
    
    protected function createDatabase()
    {
        static::bootKernel();
        $this->application = new Application(self::$kernel);
        $command = new CreateDatabaseDoctrineCommand();
        $this->application->add($command);
        $input = new ArrayInput(array(
            'command' => 'doctrine:database:create',
            '--if-not-exists' => true,
        ));
        $command->run($input, new ConsoleOutput());
    }
    
    protected function createSchema()
    {
        static::bootKernel();
        $this->application = new Application(self::$kernel);
        $command = new CreateSchemaDoctrineCommand();
        $this->application->add($command);
        $input = new ArrayInput(array(
            'command' => 'doctrine:schema:create',
        ));
        $command->run($input, new ConsoleOutput());
    }

    /*
    protected function setUp()
    {
        static::bootKernel();
    }

    protected function tearDown()
    {
    }
    */
}
